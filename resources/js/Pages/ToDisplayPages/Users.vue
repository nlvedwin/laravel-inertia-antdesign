<script setup>
import Table from "@/Components/Table.vue";
import { UserAddOutlined } from "@ant-design/icons-vue";
import axios from "axios";
import { ref } from "vue";
import AddNewUser from "../Forms/AddNewUser.vue";
const props = defineProps({ selectedProject: String, users: Array });

const visible = ref(false);
const toEditData = ref();
const searchData = ref("");
const getHide = (value) => {
    visible.value = value;
};
const onEditRecord = (value) => {
    axios.get("/api/users-management/" + value).then((response) => {
        toEditData.value = response.data;
        visible.value = true;
    });
};

const onSearch = (search) => {
    searchData.value = search;
};

const returnSearched = (value) => {
    let newVal = [];
    if (!searchData.value) {
        return value;
    } else {
        newVal = value.filter((val) => {
            return (
                val.firstname.toLowerCase().includes(searchData.value) ||
                val.lastname.toLowerCase().includes(searchData.value) ||
                val.age.includes(searchData.value) ||
                val.address.toLowerCase().includes(searchData.value)
            );
        });

        return newVal;
    }
};
</script>
<template>
    <a-space direction="vertical">
        <a-input-search
            placeholder="Search...."
            style="width: 200px"
            @search="onSearch"
        />
    </a-space>
    <div style="margin-bottom: 20px; float: right">
        <a-button @click="visible = !visible"
            ><UserAddOutlined /> Add new User</a-button
        >
    </div>
    <Table :data="returnSearched($page.props.users)" @onEdit="onEditRecord" />

    <AddNewUser
        v-if="visible"
        :toEditData="toEditData"
        :show="visible || toEditData !== undefined"
        @hideModal="getHide($event)"
    ></AddNewUser>
</template>
