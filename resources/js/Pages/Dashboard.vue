<script setup>
import Chart from '@/Components/Chart.vue';
const props = defineProps({ selectedProject: String })
</script>
<template>
    <h1>Dashboard</h1>
</template>

<style scoped>
.column {
    float: left;
    width: 50%;
    padding: 10px;
    height: 300px;
}

.row:after {
    content: "";
    display: table;
    clear: both;
}
</style>