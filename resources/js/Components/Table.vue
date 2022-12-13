<script setup>
import { ref } from "vue";
import { DeleteOutlined, EditOutlined } from "@ant-design/icons-vue";
import { Inertia } from "@inertiajs/inertia";
const columns = ref([
    {
        title: "Name",
        dataIndex: "name",
        width: "30%",
    },
    {
        title: "Age",
        dataIndex: "age",
    },
    {
        title: "Address",
        dataIndex: "address",
    },
    {
        title: "Operation",
        dataIndex: "operation",
    },
])
const props = defineProps({
    data: Array
})
const emit = defineEmits(['onEdit'])
const onEdit = (record) => {
    emit('onEdit', record.id)
}
const onDelete = (key) => {
    Inertia.delete('/users-management/' + key.id)
};
</script>
<template>
    <a-table bordered :data-source="data" :columns="columns">
        <template #bodyCell="{ column, text, record }">
            <template v-if="column.dataIndex === 'name'">
                <div class="editable-cell">
                    <div>
                        {{ record.firstname  + ' ' + record.lastname }}
                    </div>
                </div>
            </template>
            <template v-else-if="column.dataIndex === 'operation'">
                <a-button
                    class="mr-5"
                    type="primary"
                    @click="onEdit(record)"
                >
                    <template #icon>
                        <EditOutlined></EditOutlined>
                    </template>
                </a-button>
                <a-popconfirm
                    title="Are you sure do you want to delete this User?"
                    ok-text="Yes"
                    cancel-text="No"
                    @confirm="onDelete(record)"
                >
                    <a-button type="danger">
                        <template #icon>
                            <DeleteOutlined/>
                        </template>
                    </a-button>
                </a-popconfirm>
            </template>
        </template>
    </a-table>
</template>
