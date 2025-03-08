<script setup lang="ts">
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3';
import ForgotPasswordComponent from '@/components/app/ForgotPassword.vue';

defineProps<{
    status?: string;
}>();
</script>

<template>
    <AuthLayout title="Forgot password" description="Enter your email to receive a password reset link">
        <Head title="Forgot password" />
        <ForgotPasswordComponent :status="status" />
    </AuthLayout>
</template>
