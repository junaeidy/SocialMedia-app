<template>
    <nav class="absolute top-0 left-0 w-full bg-transparent px-6 py-4 z-10">
            <div class="flex justify-between items-center container mx-auto">
                <!-- Logo -->
                <div class="text-2xl font-semibold text-white">Discussy</div>
                <!-- Right Menu -->
                <div class="space-x-4">
                    <Link :href="route('login')" class="text-white hover:text-blue-400">Login</Link>
                    <Link :href="route('register')" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                        Register
                    </Link>
                </div>
            </div>
        </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3';
    export default {
        name: "Navbar",
        components : {
            Link,
        },
};
</script>

<style lang="stylus" scoped>

</style>