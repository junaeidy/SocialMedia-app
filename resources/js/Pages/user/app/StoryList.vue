<template>
  <div class="relative mb-4 p-3 bg-white rounded-lg shadow-md">
    <button
      v-if="showNavigation && canScrollLeft"
      @click="scrollLeft"
      class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-200 z-10"
    >
      ◀
    </button>

    <div
      ref="storyContainer"
      class="flex space-x-4 overflow-x-auto scrollbar-hide scroll-smooth whitespace-nowrap px-2"
    >
      <label class="cursor-pointer shrink-0">
        <div class="w-24 h-32 bg-gray-300 rounded-lg flex flex-col items-center justify-center">
          <span class="text-xl font-bold">+</span>
          <span class="text-xs">Buat cerita</span>
        </div>
        <input type="file" class="hidden" @change="uploadStory" />
      </label>

      <div v-for="story in stories" :key="story.id" class="relative shrink-0 w-24 h-32 rounded-lg overflow-hidden">
        <img
          v-if="story.user"
          :src="story.user.avatar_url"
          class="absolute top-1 left-1 w-8 h-8 rounded-full border-2 border-white"
        />

        <img
          :src="story.image"
          class="w-full h-full object-cover rounded-lg"
        />

       <span v-if="story.user" class="absolute bottom-1 left-1 text-white text-xs font-semibold bg-black bg-opacity-50 px-1 py-0.5 rounded text-left leading-tight break-words w-auto max-w-[90%]" style="word-wrap: break-word; white-space: normal;">
          {{ story.user.name }}
        </span>

      </div>
    </div>

    <button
      v-if="showNavigation && canScrollRight"
      @click="scrollRight"
      class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-200 z-10"
    >
      ▶
    </button>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watchEffect } from "vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  stories: Array,
});

const form = useForm({
  image: null,
});

const uploadStory = (e) => {
  form.image = e.target.files[0];
  form.post("/stories", {
    onSuccess: () => {
      form.reset();
    },
  });
};

const storyContainer = ref(null);

const showNavigation = computed(() => props.stories.length > 6);

const scrollLeft = () => {
  if (storyContainer.value) {
    storyContainer.value.scrollBy({ left: -150, behavior: "smooth" });
  }
};

const scrollRight = () => {
  if (storyContainer.value) {
    storyContainer.value.scrollBy({ left: 150, behavior: "smooth" });
  }
};

const canScrollLeft = ref(false);
const canScrollRight = ref(false);

const updateScrollState = () => {
  if (storyContainer.value) {
    canScrollLeft.value = storyContainer.value.scrollLeft > 0;
    canScrollRight.value =
      storyContainer.value.scrollLeft < storyContainer.value.scrollWidth - storyContainer.value.clientWidth;
  }
};

onMounted(() => {
  if (storyContainer.value) {
    storyContainer.value.addEventListener("scroll", updateScrollState);
    updateScrollState();
  }
});

watchEffect(() => {
  setTimeout(() => {
    updateScrollState();
  }, 100);
});
</script>

<style>

.scrollbar-hide::-webkit-scrollbar {
  display: none;
}
.scrollbar-hide {
  -ms-overflow-style: none;
  scrollbar-width: none;
}
</style>
