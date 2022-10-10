<script setup>
import {
    TeamOutlined,
    HomeOutlined,
    MenuUnfoldOutlined,
    MenuFoldOutlined,
    FolderOutlined,
    CalendarOutlined,
    FolderOpenOutlined,
    LineChartOutlined,
    DownOutlined,
} from "@ant-design/icons-vue";
import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";

const collapsed = ref(false);
const emits = defineEmits(["selectedComponent"]);
const props = defineProps({
    index: String,
});

const menus = ref([
    {
        title: "Dashboard",
        icon: HomeOutlined,
    },
    {
        title: "Team",
        icon: TeamOutlined,
    },
    {
        title: "Projects",
        icon: FolderOutlined,
        submenu: ["Project 1", "Project 2", "Project 3"],
    },
    {
        title: "Calendar",
        icon: CalendarOutlined,
    },
    {
        title: "Documents",
        icon: FolderOpenOutlined,
        submenu: ["Document 1", "Document 2", "Document 3"],
    },
    {
        title: "Reports",
        icon: LineChartOutlined,
    },
]);
const selectedMenu = ref([Number(props.index)]);

const onClick = ({ key }) => {
    Inertia.post("/logout");
};

watch(selectedMenu, (value) => {
    value[0].project === undefined
        ? Inertia.get("/dashboard/" + menus.value[value[0]].title, value[0])
        : Inertia.get(
              "/dashboard/" + menus.value[value[0].index].title,
              value[0].index
          );
    emits("selectedComponent", value[0]);
});
</script>
<template>
    <a-layout class="h-screen">
        <a-layout-sider
            v-model:collapsed="collapsed"
            :trigger="null"
            collapsible
            width="280"
        >
            <div class="p-5 mb-7">
                <img src="/assets/logo_white.png" />
            </div>
            <a-menu
                theme="dark"
                mode="inline"
                v-model:selectedKeys="selectedMenu"
            >
                <a v-for="(menu, index) of menus">
                    <a-menu-item v-if="menu.submenu === undefined" :key="index">
                        <component
                            :is="menu.icon"
                            style="font-size: 25px"
                        ></component>
                        <span class="nav-text p-2" style="font-size: 15px">{{
                            menu.title
                        }}</span>
                    </a-menu-item>
                    <a-sub-menu v-else :key="'sub_menu' + index">
                        <template #icon>
                            <component
                                :is="menu.icon"
                                style="font-size: 25px"
                            ></component>
                        </template>
                        <template #title>{{ menu.title }}</template>
                        <a-menu-item
                            v-for="(project, i) of menu.submenu"
                            :key="{ index: index, project: project, pro_index: i }"
                            >{{ project }}</a-menu-item
                        >
                        <a-sub-menu key="sub1-2" title="Submenu">
                            <a-menu-item key="5">Option 5</a-menu-item>
                            <a-menu-item key="6">Option 6</a-menu-item>
                        </a-sub-menu>
                    </a-sub-menu>
                </a>
            </a-menu>
        </a-layout-sider>
        <a-layout class="h-screen">
            <a-layout-header style="background: #fff; padding-left: 25px">
                <menu-unfold-outlined
                    v-if="collapsed"
                    class="trigger"
                    @click="() => (collapsed = !collapsed)"
                />
                <menu-fold-outlined
                    v-else
                    class="trigger"
                    @click="() => (collapsed = !collapsed)"
                />
                <a-dropdown class="float-right mt-3">
                    <img
                        class="w-10 h-10 rounded-full"
                        :src="'/' + $page.props.auth.user.email + '.png'"
                        alt=""
                    />
                    <template #overlay>
                        <a-menu @click="onClick">
                            <a-menu-item key="1">Logout</a-menu-item>
                        </a-menu>
                    </template>
                </a-dropdown>
            </a-layout-header>
            <h1 class="text-3xl m-5">
                {{
                    menus[selectedMenu[0]] !== undefined
                        ? menus[selectedMenu[0]].title
                        : "Dashboard"
                }}
            </h1>
            <a-layout-content
                :style="{
                    margin: '24px 16px',
                    padding: '24px',
                    background: '#fff',
                    minHeight: '280px',
                }"
            >
                <slot></slot>
            </a-layout-content>
            <a-layout-footer style="text-align: center">
                Ant Design ©2018 Created by Ant UED
            </a-layout-footer>
        </a-layout>
    </a-layout>
</template>
