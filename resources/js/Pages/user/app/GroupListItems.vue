<script setup>
import GroupItems from './GroupItems.vue';
import TextInput from '@/Components/TextInput.vue';
import {ref, watch} from "vue";
import GroupModal from './GroupModal.vue';
import { router } from '@inertiajs/vue3'
const showNewGroupModal = ref(false)
const searchKeyword = ref('')
const props = defineProps({
    groups: Array
    
})
function onGroupCreate(group) {
    props.groups.unshift(group)
}

</script>

<template>
    <div class="flex gap-2  mt-4">
        <TextInput :model-value="searchKeyword" placeholder="Type to search" class="w-full"/>
        <button @click="showNewGroupModal = true"
                class="text-sm bg-indigo-500 hover:bg-indigo-600 text-white rounded py-1 px-2 w-[120px]">
            new group
        </button>
    </div>
    <div class="mt-3 h-[200px] lg:flex-1 overflow-auto">
        <div v-if="groups.length === 0" class="text-gray-400 text-center p-3">
            You are not joined to any groups
        </div>
        <div v-else>
            <GroupItems v-for="group of groups" :group="group"/>
        </div>
    </div>
    <GroupModal v-model="showNewGroupModal" @create="onGroupCreate"/>
</template>

<style scoped>
</style>