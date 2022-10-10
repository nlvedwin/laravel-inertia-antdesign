<script setup>
const props = defineProps({
    selectedProject: String
})
</script>

<template>
    <h1>{{ props.selectedProject }}</h1>
</template>