<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import { Head, Link, useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <a-form layout="vertical" @submit.prevent="submit">
            <a-form-item label="Name">
                <a-input
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model:value="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </a-form-item>
            <a-form-item label="Email">
                <a-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model:value="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </a-form-item>

            <a-form-item label="Password">
                <a-input
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model:value="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </a-form-item>

            <a-form-item label="Confirm Password">
                <a-input
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model:value="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </a-form-item>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900"
                >
                    Already registered?
                </Link>
                <a-button
                    :class="{ 'opacity-25': form.processing }"
                    html-type="submit"
                    :loading="form.processing"
                    class="ml-4"
                    type="primary"
                    >Register
                </a-button>
            </div>
        </a-form>
    </GuestLayout>
</template>
