<script setup>
import PostItems from './PostItems.vue';
import PostModal from './PostModal.vue';
import {ref} from "vue";

defineProps({
    posts: Array
})

const showEditModal = ref(false)
const editPost = ref({})
function openEditModal(post) {
    editPost.value = post;
    showEditModal.value = true;
}
const post1 = {
    user: {
        id: 1,
        avatar: 'https://randomuser.me/api/portraits/men/46.jpg',
        name: 'Junaeidy Setiawan'
    },
    group: null,
    attachments: [
        {
            id: 1,
            name: 'test.png',
            url: 'https://picsum.photos/1000',
            mime: 'image/png'
        },
        {
            id: 2,
            name: 'test2.png',
            url: 'https://picsum.photos/1000',
            mime: 'image/png'
        },
        {
            id: 3,
            name: 'MyDocument.docx',
            url: '#',
            mime: 'application/msword'
        },
    ],
    body: '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis ullam, aspernatur obcaecati aliquid repudiandae quaerat, earum quae, exercitationem deserunt non laudantium quis placeat eligendi fugit molestiae. Quaerat fugiat quae dicta.</p>',
    created_at: '2024-06-26 23:50'
}
const post2 = {
    user: {
        id: 1,
        avatar: 'https://randomuser.me/api/portraits/lego/4.jpg',
        name: 'Siti Rahma Br Sitorus'
    },
    group: {
        id: 1,
        name: 'Fisika Dasar 2'
    },
    body: '<p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis ullam, aspernatur obcaecati aliquid repudiandae quaerat, earum quae, exercitationem deserunt non laudantium quis placeat eligendi fugit molestiae. Quaerat fugiat quae dicta. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facilis ullam, aspernatur obcaecati aliquid repudiandae quaerat, earum quae, exercitationem deserunt non laudantium quis placeat eligendi fugit molestiae. Quaerat fugiat quae dicta.</p>',
    created_at: '2024-06-26 23:59'
}
</script>

<template>
    <div class="overflow-auto">
        <PostItems v-for="post of posts" :key="post.id" :post="post" @editClick="openEditModal"/>

        <PostModal :post="editPost" v-model="showEditModal"/>
    </div>
</template>

<style scoped>
</style>