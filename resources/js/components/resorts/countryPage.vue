

<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts ',href: '/resorts' },
    { title: 'country',href: '/resorts/country' },

];

</script>

<template>
    <Head title="Resorts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4 rounded-xl">
            <h1> country</h1>
        </div>
    </AppLayout>
</template>
