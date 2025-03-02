<script setup>
import { Head, usePage } from "@inertiajs/vue3";
import { ref, computed, watch } from "vue";
import FollowingList from "@/Pages/user/app/FollowingList.vue";
import GroupList from "@/Pages/user/app/GroupList.vue";
import CreatePost from "@/Pages/user/app/CreatePost.vue";
import PostList from "@/Pages/user/app/PostList.vue";
import StoryList from "@/Pages/user/app/StoryList.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const props = defineProps({
    posts: Object,
    groups: Array,
    followings: Array,
    stories: Array, 
});

// Ambil flash message dari Laravel
const page = usePage();
const successMessage = computed(() => page.props.flash?.success || null);
const showMessage = ref(false);

// Auto-hide notifikasi setelah 3 detik
watch(successMessage, (newValue) => {
    if (newValue) {
        showMessage.value = true;
        setTimeout(() => {
            showMessage.value = false;
        }, 3000);
    }
});
</script>

<template>
  <Head title="Homepage" />
  <AuthenticatedLayout>
      <!-- Notifikasi Flash Message -->
      <transition name="fade">
          <div v-if="showMessage" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg z-50">
              {{ successMessage }}
          </div>
      </transition>

      <div class="grid lg:grid-cols-12 gap-3 p-4 h-full">
          <!-- Sidebar Kiri (Groups) -->
          <div class="lg:col-span-3 lg:order-1 h-full overflow-hidden">
              <GroupList :groups="groups ?? []"/>
          </div>

          <!-- Sidebar Kanan (Following) -->
          <div class="lg:col-span-3 lg:order-3 h-full overflow-hidden">
              <FollowingList :users="followings ?? []"/>
          </div>

          <!-- Konten Utama (Post & Story) -->
          <div class="lg:col-span-6 lg:order-2 h-full overflow-hidden flex flex-col">
              <CreatePost/>
              <StoryList :stories="stories ?? []" /> 
              <PostList :posts="posts?.data ?? []" class="flex-1"/>
          </div>
      </div>
  </AuthenticatedLayout>
</template>

<style>
/* Animasi Fade untuk Notifikasi */
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to {
  opacity: 0;
}
</style>
