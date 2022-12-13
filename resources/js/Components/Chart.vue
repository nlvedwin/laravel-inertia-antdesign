<!-- <script setup>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { ref } from 'vue';

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale);

const props = defineProps({
    chartId: {
        type: String,
        default: 'bar-chart'
    },
    datasetIdKey: {
        type: String,
        default: 'label'
    },
    width: {
        type: Number,
        default: 500
    },
    height: {
        type: Number,
        default: 400
    },
    cssClasses: {
        default: '',
        type: String
    },
    styles: {
        type: Object,
        default: () => { }
    },
    plugins: {
        type: Object,
        default: () => { }
    }
})

const chartData = ref(
    {
        labels: ['January', 'February', 'March', 'April', 'May', 'June'],
        datasets: [
            {
                data: [40, 20, 12, 40, 20, 12],
                label: 'Data One'
            }
        ]
    }
)
const chartOptions = ref({ responsive: true })
</script>

<template>
    <div class="w-9/12 h-9/12 p-3">
        <Bar :chart-options="chartOptions" :chart-data="chartData" :chart-id="chartId" :dataset-id-key="datasetIdKey"
            :plugins="plugins" :css-classes="cssClasses" :styles="styles" :width="width" :height="height" />
    </div>
</template> -->
