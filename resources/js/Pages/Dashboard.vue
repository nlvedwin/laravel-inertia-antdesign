<script setup>
import Chart from '@/Components/Chart.vue';
const props = defineProps({ selectedProject: String })
</script>
<template>
    <div class="row">
        <div class="column">
            <Chart></Chart>
        </div>
        <div class="column">
            <Chart></Chart>
        </div>
    </div>
    <br><br><br><br><br><br>
    <div class="row">
        <div class="column">
            <Chart></Chart>
        </div>
        <div class="column">
            <Chart></Chart>
        </div>
    </div>

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