<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <a-form layout="vertical" @submit.prevent="submit">
            <a-form-item label="Email">
                <a-input id="email" type="email" class="mt-1 block w-full" v-model:value="form.email" required autofocus autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </a-form-item>

            <a-form-item label="Password">
                <a-input id="password" type="password" class="mt-1 block w-full" v-model:value="form.password" required autocomplete="current-password" />
                <InputError class="mt-2" :message="form.errors.password" />
            </a-form-item>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a-button html-type="submit" :loading="form.processing" class="ml-4" type="primary" >Login </a-button>
            </div>
        </a-form>
    </GuestLayout>
</template>
