<script setup>
import {Link} from '@inertiajs/vue3';
import {ChevronRightIcon} from "@heroicons/vue/24/solid/index.js";
import dayjs from 'dayjs';
import relativeTime from 'dayjs/plugin/relativeTime';

dayjs.extend(relativeTime);

defineProps({
    post: {
        type: Object
    },
    showTime: {
        type: Boolean,
        default: true
    }
})

const formatTime = (dateString) => {
    const date = dayjs(dateString);
    const now = dayjs();
    
    if (now.diff(date, 'day') >= 7) {
        return date.format('YYYY-MM-DD HH:mm:ss');
    }

    return date.fromNow();
};
</script>

<template>
    <div class="flex items-center gap-2 ">
        <Link :href="route('profile', post.user.username)">
            <img :src="post.user.avatar_url"
                 class="w-[48px] h-[48px] rounded-full  border-2 transition-all hover:border-blue-500"/>
        </Link>
        <div>
            <h4 class="flex items-center font-bold">
                <Link :href="route('profile', post.user.username)" class="hover:underline">
                    {{ post.user.name }}
                </Link>
                <template v-if="post.group">
                    <ChevronRightIcon class="w-4"/>
                    <Link :href="route('group.profile', post.group.slug)" class="hover:underline">
                        {{ post.group.name }}
                    </Link>
                </template>
            </h4>
            <small v-if="showTime" class="text-gray-400">{{ formatTime(post.updated_at) }}</small>
        </div>
    </div>
</template>

<style scoped>
</style>