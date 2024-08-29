<script setup>
    import { Head, Link } from '@inertiajs/vue3';
    import FollowingList from '@/Pages/user/app/FollowingList.vue';
    import GroupList from '@/Pages/user/app/GroupList.vue';
    import CreatePost from '@/Pages/user/app/CreatePost.vue';
    import PostList from '@/Pages/user/app/PostList.vue';
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    posts: Object
});
</script>

<template>
    <Head title="Homepage" />
    <AuthenticatedLayout>
        <div class="grid lg:grid-cols-12 gap-3 p-4 h-full">
            <div class="lg:col-span-3 lg:order-1 h-full overflow-hidden">
                <GroupList/>
            </div>
            <div class="lg:col-span-3 lg:order-3 h-full overflow-hidden">
                <FollowingList/>
            </div>
            <div class="lg:col-span-6 lg:order-2 h-full overflow-hidden flex flex-col">
                <CreatePost/>
                <PostList :posts="posts.data" class="flex-1"/>
            </div>
        </div>
    </AuthenticatedLayout>
    
</template>

<style>

</style>
