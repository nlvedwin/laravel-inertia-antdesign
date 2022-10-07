<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import PersistentLayout from '@/Layouts/PersistentLayout.vue';
import { ref } from 'vue';
import Dashboard from '@/Pages/Dashboard.vue';
import Calendar from '@/Pages/ToDisplayPages/Calendar.vue';
import Documents from '@/Pages/ToDisplayPages/Documents.vue';
import Projects from '@/Pages/ToDisplayPages/Projects.vue';
import Reports from '@/Pages/ToDisplayPages/Reports.vue';
import Team from './ToDisplayPages/Team.vue';
const props = defineProps({
    request: String,
    PersistentLayout,
    index: String
})
const listComponents = [Dashboard, Team, Projects, Calendar, Documents,  Reports];
let index = ref(Number(props.index));

const getSelectedComponent = (value) => {
    index.value = value;
}
</script>
    
<template>
    <Head :title="props.request" />

    <PersistentLayout @selectedComponent="getSelectedComponent" :index="props.index">
        <component :is="listComponents[index]"></component>
    </PersistentLayout>
</template>
    