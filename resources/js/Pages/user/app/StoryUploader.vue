<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
  image: null,
});

const uploadStory = (e) => {
  form.image = e.target.files[0];
  form.post("/stories");
};
</script>

<template>
  <div class="flex items-center space-x-2 p-2">
    <label class="cursor-pointer">
      <div class="w-16 h-16 bg-gray-300 rounded-full flex items-center justify-center">
        <span class="text-xl">+</span>
      </div>
      <input type="file" class="hidden" @change="uploadStory" />
    </label>

    <span class="text-gray-500 text-sm">Buat cerita Anda</span>
  </div>
</template>
