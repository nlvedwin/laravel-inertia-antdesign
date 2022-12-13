<script setup>
import { ref, onMounted } from "vue";
import { CloseOutlined } from "@ant-design/icons-vue";

const visible = ref(props.show);
const emits = defineEmits(["hideModal"]);
const props = defineProps({
    show: Boolean,
    title: String,
});
</script>

<template>
    <div>
        <a-modal
            width="700px"
            :footer="false"
            :closable="false"
            :visible="visible"
        >
            <template #title>
                <div class="flex justify-between items-center">
                    <h1 class="text-black">{{ title }}</h1>
                    <a-button
                        type="primary"
                        @click="emits('hideModal', false)"
                        size="large"
                    >
                        <template #icon>
                            <CloseOutlined />
                        </template>
                    </a-button>
                </div>
            </template>
            <slot></slot>
        </a-modal>
    </div>
</template>
