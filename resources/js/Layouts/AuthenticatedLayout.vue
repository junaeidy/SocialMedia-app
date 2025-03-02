<script setup>
import { onMounted , ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import {Link, router, usePage} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import {MoonIcon} from '@heroicons/vue/24/solid'

const showingNavigationDropdown = ref(false);
const keywords = ref(usePage().props.search || '')
const authUser = usePage().props.auth.user;

const props = defineProps({
    user: {
        type: Object
    },
    post: Object
});

function search() {
    router.get(route('search', encodeURIComponent(keywords.value)))
}
function toggleDarkMode(){
    const html = window.document.documentElement
    if (html.classList.contains('dark')) {
        html.classList.remove('dark')
        localStorage.setItem('darkMode', '0')
    } else {
        html.classList.add('dark')
        localStorage.setItem('darkMode', '1')
    }
}

</script>

<template>
        <div class="h-full overflow-hidden flex flex-col bg-gray-100 dark:bg-gray-800">
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between gap-2 h-16">
                        <div class="flex mr-2">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('home')">
                                    <ApplicationLogo
                                        class="block fill-current text-gray-800 dark:text-gray-200 rounded-full w-[50px] h-[50px]"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                
                            </div>
                        </div>
                        <div class="flex items-center gap-3 flex-1">
                        <TextInput v-model="keywords" placeholder="Search on the website" class="w-full" @keyup.enter="search"/>
                        <button @click="toggleDarkMode" class="dark:text-white">
                            <MoonIcon class="w-5 h-5"/>
                        </button>
                        </div>
                        <div class="hidden sm:flex sm:items-center">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown v-if="authUser" align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                            >
                                            <img class="w-[50px] h-[50px] rounded-full object-cover" :src="authUser.avatar_url || user.avatar_url"/>
                                            </button>

                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile', {username: authUser.username })">
                                            Profile
                                        </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                                <div v-else>
                                <Link :href="route('login')" class="dark:text-gray-100">
                                    Login
                                </Link>
                            </div>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                       
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                        <template v-if="authUser">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                    {{ authUser.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">{{ authUser.email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink :href="route('profile', {username: authUser.username })"> Profile
                                </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </div>
                        </template>
                        <template>
                            Login button
                        </template>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white dark:bg-gray-800 shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main class="overflow-hidden flex-1">
                <slot />
            </main>
        </div>
</template>
