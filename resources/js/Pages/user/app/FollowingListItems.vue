<script setup>
import FollowingItems from '@/Pages/user/app/FollowingItems.vue';
import TextInput from '@/Components/TextInput.vue';
import {ref} from "vue";
const searchKeyword = ref('')
</script>

<template>
    <TextInput :model-value="searchKeyword" placeholder="Type to search" class="w-full mt-3"/>
    <div class="mt-3 h-[200px] lg:flex-1 overflow-auto">
        <div v-if="false" class="text-gray-400 text-center p-3">
            You don't have friends yet.
        </div>
        <div v-else>
            <FollowingItems image="https://picsum.photos/100"
                           title="John Doe"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="Elon Musk"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="John Doe"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="Elon Musk"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="John Doe"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="Elon Musk"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="John Doe"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="Elon Musk"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="John Doe"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="Elon Musk"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="John Doe"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="Elon Musk"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="John Doe"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
            <FollowingItems image="https://picsum.photos/100"
                           title="Elon Musk"
                           description="Lorem ipsum dolor sit amet, consectetur adipisicing elit."/>
        </div>
    </div>
</template>

<style scoped>
</style>