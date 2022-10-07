<script setup>
import { UserOutlined, HomeOutlined, MenuUnfoldOutlined, MenuFoldOutlined, FolderOutlined, CalendarOutlined, FolderOpenOutlined, LineChartOutlined, DownOutlined } from '@ant-design/icons-vue';
import { Inertia } from '@inertiajs/inertia';
import { ref, watch } from 'vue';

const collapsed = ref(false);
const emits = defineEmits(['selectedComponent']);
const props = defineProps({
    index: String
})

const menus = ref(
    [
        {
            title: 'Dashboard',
            icon: HomeOutlined
        },
        {
            title: 'Team',
            icon: UserOutlined
        },
        {
            title: 'Projects',
            icon: FolderOutlined
        },
        {
            title: 'Calendar',
            icon: CalendarOutlined
        },
        {
            title: 'Documents',
            icon: FolderOpenOutlined
        },
        {
            title: 'Reports',
            icon: LineChartOutlined
        },
    ]
)
const selectedMenu = ref([Number(props.index)]);

const onClick = ({
    key,
}) => {
    Inertia.post('/logout')
};

watch(selectedMenu, (value) => {
    Inertia.get('/dashboard/' + menus.value[value[0]].title, value[0]);
    emits('selectedComponent', value[0])
})

</script>
<template>
    <a-layout class="h-screen">
        <a-layout-sider v-model:collapsed="collapsed" :trigger="null" collapsible width="280">
            <div class="p-5 mb-7">
                <img src="/assets/logo_white.png">
            </div>
            <a-menu theme="dark" mode="inline" v-model:selectedKeys="selectedMenu">
                <a-menu-item v-for="(menu, index) of menus" :key="index">
                    <component :is="menu.icon" style="font-size: 25px;"></component>
                    <span class="nav-text p-2" style="font-size: 15px;">{{ menu.title }}</span>
                </a-menu-item>
            </a-menu>
        </a-layout-sider>
        <a-layout class="h-screen">
            <a-layout-header style="background: #fff; padding-left: 25px">
                <menu-unfold-outlined v-if="collapsed" class="trigger" @click="() => (collapsed = !collapsed)" />
                <menu-fold-outlined v-else class="trigger" @click="() => (collapsed = !collapsed)" />
                <a-dropdown class="float-right mt-3">
                    <a-button class="ant-dropdown-link" @click.prevent>
                        <UserOutlined />
                        {{ $page.props.auth.user.name }}
                        <DownOutlined />
                    </a-button>
                    <template #overlay>
                        <a-menu @click="onClick">
                            <a-menu-item key="1">Logout</a-menu-item>
                        </a-menu>
                    </template>
                </a-dropdown>
            </a-layout-header>
            <h1 class="text-3xl m-5">{{ menus[selectedMenu[0]] !== undefined ? menus[selectedMenu[0]].title :
            'Dashboard' }}</h1>
            <a-layout-content :style="{ margin: '24px 16px', padding: '24px', background: '#fff', minHeight: '280px' }">
                <slot></slot>
            </a-layout-content>
            <a-layout-footer style="text-align: center">
                Ant Design ©2018 Created by Ant UED
            </a-layout-footer>
        </a-layout>
    </a-layout>
</template>