<script setup>
import Table from '@/Components/Table.vue';
import { UserAddOutlined } from '@ant-design/icons-vue';
import axios from 'axios';
import {onMounted, ref } from 'vue';
import AddNewUser from '../Forms/AddNewUser.vue';
const props = defineProps({ selectedProject: String, users: Array })

const visible = ref(false);
const toEditData = ref();
const getHide = (value) => {
    visible.value = value;
}
const onEditRecord = (value) => {
    axios.get('/api/users-management/' + value).then((response) => {
        toEditData.value = response.data;
        visible.value = true
    })
}
</script>
<template>
    <div style="margin-bottom: 20px; float: right;">
        <a-button @click="visible = !visible"><UserAddOutlined/> Add new User</a-button>
    </div>
    <Table :data="$page.props.users" @onEdit="onEditRecord"/>

    <AddNewUser v-if="visible" :toEditData="toEditData" :show="visible || toEditData !== undefined" @hideModal="getHide($event)"></AddNewUser>
</template>