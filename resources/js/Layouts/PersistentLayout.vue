<script setup>
import {
    HomeOutlined,
    DownOutlined,
UserOutlined,
} from "@ant-design/icons-vue";
import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";

const collapsed = ref(false);
const emits = defineEmits(["selectedComponent"]);
const props = defineProps({
    index: String,
    headerTitle: String
});

const menus = ref([
    {
        title: "Dashboard",
        icon: HomeOutlined,
    },
    {
        title: "Users Management",
        icon: UserOutlined,
    }
]);
const selectedMenu = ref([Number(props.index)]);
const openKeys = ref(["sub_menu" + props.index]);

const onClick = ({ key }) => {
    Inertia.post("/logout");
};

watch(selectedMenu, (value) => {
    value[0].project === undefined
        ? Inertia.get("/laravel-inertia/" + menus.value[value[0]].title, value[0])
        : Inertia.get("/laravel-inertia/" + menus.value[value[0].index].title, {
            index: value[0].index,
            render: value[0].project,
        });
    if (value[0].project) openKeys.value[0] = "sub_menu" + value[0].index;
});
</script>
<template>
    <a-layout class="h-screen">
        <a-layout-sider  :trigger="null" width="240" :style="{ overflow: 'auto', height: '100vh', position: 'fixed', left: 0, top: 0, bottom: 0 }">
            <div class="p-5 mb-7">
                <img src="/assets/logo_white.png" />
            </div>
            <a-menu theme="dark" mode="inline" v-model:selectedKeys="selectedMenu" v-model:openKeys="openKeys"
                style="width: 240px">
                <a v-for="(menu, index) of menus">
                    <a-menu-item :key="index">
                        <component :is="menu.icon"></component>
                        <span v-if="!collapsed" class="nav-text p-2" style="font-size: 15px">{{ menu.title }}</span>
                    </a-menu-item>
                </a>
            </a-menu>
        </a-layout-sider>
        <a-layout class="h-screen" :style="{ marginLeft: '250px' }">
            <a-layout-header style="background: #fff; padding-left: 25px">
                <a-dropdown class="float-right">
                    <a class="ant-dropdown-link" style="font-size: 15px" @click.prevent>
                        {{ $page.props.auth.user.name }}
                        <DownOutlined />
                    </a>

                    <template #overlay>
                        <a-menu>
                            <a-menu-item key="2" @click="onClick">Logout</a-menu-item>
                        </a-menu>
                    </template>
                </a-dropdown>
            </a-layout-header>
            <h1 class="text-3xl m-5">
                {{ props.headerTitle }}
            </h1>
            <div :style="{
                margin: '24px 16px',
                padding: '24px',
                background: '#fff',
                height: '100%'
            }">
                <slot></slot>
            </div>
        </a-layout>
    </a-layout>
</template>
