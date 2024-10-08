<script setup>
import {computed, ref} from 'vue'
import {TabGroup, TabList, Tab, TabPanels, TabPanel} from '@headlessui/vue'
import {usePage} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TabItems from './Partials/TabItems.vue';
import Edit from "@/Pages/Profile/Edit.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {XMarkIcon, CheckCircleIcon, CameraIcon} from '@heroicons/vue/24/solid';
import {useForm} from '@inertiajs/vue3'


let coverImageFile = null
const showNotification = ref(true)
const coverImageSrc = ref('')
const avatarImageSrc = ref('')
const authUser = usePage().props.auth.user;
const isMyProfile = computed(() => authUser && authUser.id === props.user.id)
const props = defineProps({
    errors: Object,

    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    success: {
        type: String,
    },
    user: {
        type: Object
    }
});
const imagesForm = useForm({
    avatar: null,
    cover: null,
  })

  function onCoverChange(event){
  imagesForm.cover = event.target.files[0]
  if (imagesForm.cover) {
    const reader = new FileReader()
    reader.onload = () => {
      coverImageSrc.value = reader.result;
    }
    reader.readAsDataURL(imagesForm.cover)
  }
 }
 function onAvatarChange(event) {
    imagesForm.avatar = event.target.files[0]
    if (imagesForm.avatar) {
        const reader = new FileReader()
        reader.onload = () => {
            avatarImageSrc.value = reader.result;
        }
        reader.readAsDataURL(imagesForm.avatar)
    }
}
function resetCoverImage() {
    imagesForm.cover = null;
    coverImageSrc.value = null
}
function resetAvatarImage() {
    imagesForm.avatar = null;
    avatarImageSrc.value = null
}
function submitCoverImage() {
    showNotification.value = true
    imagesForm.post(route('profile.updateImages'), {
        onSuccess: (user) => {
            resetCoverImage()
            setTimeout(() => {
                showNotification.value = false
            }, 3000)
        },
    })
}
function submitAvatarImage() {
    imagesForm.post(route('profile.updateImages'), {
        onSuccess: (user) => {
            resetAvatarImage()
            setTimeout(() => {
                showNotification.value = false
            }, 3000)
        },
    })
}

</script>

<template>
    <AuthenticatedLayout>
        <div class="w-[768px] mx-auto h-full overflow-auto">
            <div class="my-2 py-2 px-3 text-white font-medium text-sm bg-emerald-600 dark:text-green-400" v-show="showNotification && success">
                {{ success }}
            </div>
            <div
                v-if="errors.cover"
                class="my-2 py-2 px-3 font-medium text-sm bg-red-400 text-white"
            >
                {{ errors.cover }}
            </div>
            <div class="group relative bg-white">
                <img :src="coverImageSrc || user.cover_url || 'https://images.pexels.com/photos/1293125/pexels-photo-1293125.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'"
                     class="w-full h-[200px] object-cover">
                     <div v-if="isMyProfile" class="absolute top-2 right-2">
                    <button v-if="!coverImageSrc" class="bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center opacity-0 group-hover:opacity-100">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3 mr-2">
                        <path d="M12 9a3.75 3.75 0 1 0 0 7.5A3.75 3.75 0 0 0 12 9Z" />
                        <path fill-rule="evenodd" d="M9.344 3.071a49.52 49.52 0 0 1 5.312 0c.967.052 1.83.585 2.332 1.39l.821 1.317c.24.383.645.643 1.11.71.386.054.77.113 1.152.177 1.432.239 2.429 1.493 2.429 2.909V18a3 3 0 0 1-3 3h-15a3 3 0 0 1-3-3V9.574c0-1.416.997-2.67 2.429-2.909.382-.064.766-.123 1.151-.178a1.56 1.56 0 0 0 1.11-.71l.822-1.315a2.942 2.942 0 0 1 2.332-1.39ZM6.75 12.75a5.25 5.25 0 1 1 10.5 0 5.25 5.25 0 0 1-10.5 0Zm12-1.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                        Update Cover Image
                        <input type="file" class="absolute left-0 right-0 top-0 bottom-0 opacity-0" @change="onCoverChange">
                    </button>
                    <div v-else class="flex gap-2 opacity-0 group-hover:opacity-100 bg-white p-2">
                        <button @click="resetCoverImage" class="bg-gray-50 hover:bg-gray-100 text-gray-800 py-1 px-2 text-xs flex items-center">
                        <XMarkIcon class="size-3 mr-2" />
                        Cancel
                    </button>
                    <button @click="submitCoverImage" class="bg-gray-800 hover:bg-gray-900 text-gray-100 py-1 px-2 text-xs flex items-center">
                        <CheckCircleIcon class="size-3 mr-2" />
                        Submit
                    </button>
                    </div>
                    </div>
                <div class="flex">
                    <div class="flex items-center justify-center relative group/avatar -mt-[64px] ml-[48px] w-[128px] h-[128px] rounded-full">
                        <img :src="avatarImageSrc || user.avatar_url || 'https://img.freepik.com/free-vector/businessman-character-avatar-isolated_24877-60111.jpg?t=st=1724940896~exp=1724944496~hmac=d6e3c518f7006a0981fed325a166229e22701117330bc6a3a365075f48bc807b&w=740'"
                             class="w-full h-full object-cover rounded-full">
                        <div v-if="isMyProfile">
                            <button
                            v-if="!avatarImageSrc"
                            class="absolute left-0 top-0 right-0 bottom-0 bg-black/50 text-gray-200 rounded-full opacity-0 flex items-center justify-center group-hover/avatar:opacity-100">
                            <CameraIcon class="w-8 h-8"/>

                            <input type="file" class="absolute left-0 top-0 bottom-0 right-0 opacity-0"
                                   @change="onAvatarChange"/>
                        </button>
                        <div v-else class="absolute top-1 right-0 flex flex-col gap-2">
                            <button
                                @click="resetAvatarImage"
                                class="w-7 h-7 flex items-center justify-center bg-red-500/80 text-white rounded-full">
                                <XMarkIcon class="h-5 w-5"/>
                            </button>
                            <button
                                @click="submitAvatarImage"
                                class="w-7 h-7 flex items-center justify-center bg-emerald-500/80 text-white rounded-full">
                                <CheckCircleIcon class="h-5 w-5"/>
                            </button>
                        </div>
                        
                        </div>
                    </div>
                    <div class="flex justify-between items-center flex-1 p-4">
                        <h2 class="font-bold text-lg">{{ user.name }}</h2>
                        <!-- <PrimaryButton v-if="isMyProfile">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                            </svg>
                            Edit Profile
                        </PrimaryButton> -->
                    </div>
                </div>
            </div>
            <div class="border-t">
                <TabGroup>
                    <TabList class="flex bg-white">
                        <Tab v-slot="{ selected }" as="template">
                            <TabItems text="Posts" :selected="selected"/>
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItems text="Followers" :selected="selected"/>
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItems text="Followings" :selected="selected"/>
                        </Tab>
                        <Tab v-slot="{ selected }" as="template">
                            <TabItems text="Photos" :selected="selected"/>
                        </Tab>
                        <Tab v-if="isMyProfile" v-slot="{ selected }" as="template">
                            <TabItems text="My Profile" :selected="selected"/>
                        </Tab>
                    </TabList>

                    <TabPanels class="mt-2">
                        <TabPanel class="bg-white p-3 shadow">
                            Posts
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Followers
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Followings
                        </TabPanel>
                        <TabPanel class="bg-white p-3 shadow">
                            Photos
                        </TabPanel>
                        <TabPanel v-if="isMyProfile" >
                            <Edit :must-verify-email="mustVerifyEmail" :status="status"/>
                        </TabPanel>
                    </TabPanels>
                </TabGroup>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>

</style>