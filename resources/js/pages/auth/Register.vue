<script setup lang="ts">
import AuthBase from '@/layouts/AuthLayout.vue';
import { Head } from '@inertiajs/vue3';
import RegisterComponent from '@/components/app/Register.vue';
</script>

<template>
    <AuthBase title="Create an account" description="Enter your details below to create your account">
        <Head title="Register" />
        <RegisterComponent />
    </AuthBase>
</template>
