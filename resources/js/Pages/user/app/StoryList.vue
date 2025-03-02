<template>
  <div class="mb-4 p-3 bg-white rounded-lg shadow-md flex space-x-4 overflow-x-auto">
    <label class="cursor-pointer">
      <div class="w-20 h-32 bg-gray-300 rounded-lg flex flex-col items-center justify-center">
        <span class="text-xl font-bold">+</span>
        <span class="text-xs">Buat cerita</span>
      </div>
      <input type="file" class="hidden" @change="uploadStory" />
    </label>

    <div v-for="story in stories" :key="story.id" class="w-20 h-32">
      <img
        :src="`/storage/${story.image}`"
        class="w-full h-full object-cover rounded-lg border-2 border-blue-500"
      />
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

defineProps({
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
</script>
