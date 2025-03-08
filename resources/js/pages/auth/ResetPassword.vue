<script setup lang="ts">
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3';
import ResetPasswordComponent from '@/components/app/ResetPassword.vue';

interface Props {
    token: string;
    email: string;
}

const props = defineProps<Props>();
</script>

<template>
    <AuthLayout title="Reset password" description="Please enter your new password below">
        <Head title="Reset password" />
        <ResetPasswordComponent :token="props.token" :email="props.email" />
    </AuthLayout>
</template>
