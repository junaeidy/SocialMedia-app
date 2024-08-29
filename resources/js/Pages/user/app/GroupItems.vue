<script setup>
    defineProps({
        image: String,
        title: String,
        description: String
    })
</script>

<template>
    <div class="cursor-pointer hover:bg-gray-100">
    <div class="flex mb-3 items-start gap-1 py-2 px-3">
        <img :src="image" alt="" class="w-[32px] rounded-full" />
        <div>
            <h3 class="font-black text-lg">{{ title }}</h3>
            <div class="text-sm  text-gray-500">
                {{ description }}
            </div>
        </div>
    </div>
  </div>
</template>

<style scoped></style>