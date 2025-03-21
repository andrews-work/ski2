<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import { type BreadcrumbItem } from '@/types';

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'mates', href: '/mates' },
        { title: 'encryption', href: '/encryption' },
    ];

</script>

<template>
    <Head title="My Listings" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="flex p-4">
            <h1>
                encryption settings
            </h1>
        </div>

        </AppLayout>

</template>