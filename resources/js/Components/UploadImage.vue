<script setup>
import { PlusOutlined, LoadingOutlined } from "@ant-design/icons-vue";
import { ref } from "vue";

const emits = defineEmits(["imageEmit"]);

function getBase64(img, callback) {
    const reader = new FileReader();
    reader.addEventListener("load", () => callback(reader.result));
    reader.readAsDataURL(img);
}

const fileList = ref([]);
const loading = ref(false);
const imageUrl = ref("");

const handleChange = (info) => {
    if (info.file.status === "uploading") {
        loading.value = true;
        return;
    }
    getBase64(info.file.originFileObj, (base64Url) => {
        imageUrl.value = base64Url;
        loading.value = false;
        emits('imageEmit', imageUrl.value);
    });
};
</script>

<template>
    <div class="text-center" width="500">
        <a-upload
            v-model:file-list="fileList"
            name="avatar"
            list-type="picture-card"
            class="avatar-uploader"
            :show-upload-list="false"
            @change="handleChange"
        >
            <img v-if="imageUrl" :src="imageUrl" alt="avatar" />
            <div v-else>
                <loading-outlined v-if="loading"></loading-outlined>
                <plus-outlined v-else></plus-outlined>
                <div class="ant-upload-text">Upload</div>
            </div>
        </a-upload>
    </div>
</template>
