<script setup>
import GroupItems from './GroupItems.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref, computed } from "vue";
import GroupModal from './GroupModal.vue';

const showNewGroupModal = ref(false);
const searchKeyword = ref('');
const props = defineProps({
    groups: Array
});

const filteredGroups = computed(() => {
    if (!searchKeyword.value) return props.groups;

    return props.groups.filter(group =>
        group.name.toLowerCase().includes(searchKeyword.value.toLowerCase())
    );
});

function onGroupCreate(group) {
    props.groups.unshift(group);
}
</script>

<template>
    <div class="flex gap-2 mt-4">
        <TextInput v-model="searchKeyword" placeholder="Type to search" class="w-full" />

        <button @click="showNewGroupModal = true"
                class="text-sm bg-indigo-500 hover:bg-indigo-600 text-white rounded py-1 px-2 w-[120px]">
            New Group
        </button>
    </div>

    <div class="mt-3 h-[200px] lg:flex-1 overflow-auto">
        <div v-if="filteredGroups.length === 0" class="text-gray-400 text-center p-3">
            Group not found
        </div>

        <div v-else>
            <GroupItems v-for="group in filteredGroups" :group="group" :key="group.id" />
        </div>
    </div>

    <GroupModal v-model="showNewGroupModal" @create="onGroupCreate" />
</template>
