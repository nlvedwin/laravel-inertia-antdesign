<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import PersistentLayout from '@/Layouts/PersistentLayout.vue';
import Dashboard from '@/Pages/Dashboard.vue';
import Calendar from '@/Pages/ToDisplayPages/Calendar.vue';
import Documents from '@/Pages/ToDisplayPages/Documents.vue';
import Projects from '@/Pages/ToDisplayPages/Projects.vue';
import Reports from '@/Pages/ToDisplayPages/Reports.vue';
import Team from './ToDisplayPages/Team.vue';
const props = defineProps({
    request: String,
    PersistentLayout,
    index: String,
    object: String
})
const listComponents = [Dashboard, Team, Projects, Calendar, Documents,  Reports];
</script>
    
<template>
    <Head :title="props.request" />

    <PersistentLayout :index="props.index">
        <component :is="listComponents[!props.index ? 0 : props.index]" :selectedProject="props.object"></component>
    </PersistentLayout>
</template>
    