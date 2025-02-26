<script setup>
import UserListItems from './UserListItems.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, computed } from "vue";

const searchKeyword = ref('');

const props = defineProps({
    users: Array
});

const filteredUsers = computed(() => {
    if (!searchKeyword.value) return props.users; 

    return props.users.filter(user =>
        user.name.toLowerCase().includes(searchKeyword.value.toLowerCase())
    );
});
</script>

<template>
    <TextInput v-model="searchKeyword" placeholder="Type to search" class="w-full mt-3"/>

    <div class="mt-3 h-[200px] lg:flex-1 overflow-auto">
        <div v-if="filteredUsers.length === 0" class="text-gray-400 text-center p-3">
            User not found.
        </div>

        <div v-else>
            <UserListItems v-for="user in filteredUsers"
                          :user="user"
                          :key="user.id"
                          class="rounded-lg"/>
        </div>
    </div>
</template>
