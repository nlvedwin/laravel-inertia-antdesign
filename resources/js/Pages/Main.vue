<script setup>
import { Head } from '@inertiajs/inertia-vue3';
import PersistentLayout from '@/Layouts/PersistentLayout.vue';
import Dashboard from '@/Pages/Dashboard.vue';
import { onMounted, ref } from 'vue';
import Users from './ToDisplayPages/Users.vue';
const props = defineProps({
    request: String,
    PersistentLayout,
    index: String,
    object: String
})
const listComponents = [Dashboard, Users];
const title = ref("")
onMounted(() => {
    title.value = !props.index ? "Dashboard" : props.request;
})
</script>
    
<template>
    <Head :title="title" />

    <PersistentLayout :index="props.index" :headerTitle="title">
        <component :is="listComponents[!props.index ? 0 : props.index]" :selectedProject="props.object"></component>
    </PersistentLayout>
</template>
    