<script setup>
import BaseModal from "@/Components/BaseModal.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref, onMounted } from "vue";
import dayjs from "dayjs";
const emits = defineEmits(["hideModal"]);
const props = defineProps({
    show: Boolean,
    toEditData: Object,
});
const user = ref({});
const age = ref(0);
const generateAge = (value) => {
    age.value = new Date().getFullYear() - new Date(value.$d).getFullYear();
};
const dateFormat = "YYYY/MM/DD";

const onFinish = () => {
    let type = props.toEditData ? 'put' : 'post'
    user.value.age = age.value;
    Inertia[type]("/users-management", user.value, {
        onFinish: () => {
            emits("hideModal", false);
        },
    });
};
onMounted(() => {
    if (props.toEditData) {
        user.value = props.toEditData;
        age.value = props.toEditData.age;
        user.value.birthdate = new Date(props.toEditData.birthdate).getFullYear() + '/' + ("0" + (new Date(props.toEditData.birthdate).getMonth() + 1)).slice(-2) + '/' + ("0" + (new Date(props.toEditData.birthdate).getDay() + 1)).slice(-2)
    }
});
</script>
<template>
    <BaseModal
        :show="props.show"
        title="Add new User"
        @hideModal="emits('hideModal', $event)"
    >
        <a-form :model="user" layout="vertical" name="nest-messages">
            <a-form-item label="Firstname" name="firstname">
                <a-input v-model:value="user.firstname" />
            </a-form-item>
            <a-form-item label="Lastname" name="lastname">
                <a-input v-model:value="user.lastname" />
            </a-form-item>
            <a-form-item label="Birtdate" name="birthdate">
                <a-date-picker
                    style="width: 100%"
                    @change="generateAge"
                    :value="dayjs(user.birthdate, dateFormat)"
                    :format="dateFormat"
                />
            </a-form-item>
            <a-form-item label="Age" name="age">
                <a-input :value="age" />
            </a-form-item>
            <a-form-item label="Full Address" name="address">
                <a-input v-model:value="user.address" />
            </a-form-item>
            <a-form-item>
                <a-button class="float-right" type="primary" @click="onFinish"
                    >{{ props.toEditData ? 'Save Changes' : 'Submit' }}</a-button
                >
            </a-form-item>
        </a-form>
    </BaseModal>
</template>
