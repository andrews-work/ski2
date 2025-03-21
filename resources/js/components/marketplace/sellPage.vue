<script setup lang="ts">
    import { Link, Head } from '@inertiajs/vue3';
    import AppLayout from '@/layouts/AppLayout.vue';
    import { type BreadcrumbItem } from '@/types';
    import CreateListing from './createListing.vue';

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Marketplace', href: '/marketplace' },
        { title: 'Sell', href: '/marketplace/sell' },
    ];
</script>

<template>
    <Head title="Marketplace - Sell" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4 rounded-xl">

            <!-- toggle -->
            <div class="grid items-center justify-center gap-4 md:grid-cols-2">
                <Link :href="route('marketplace')" class="text-4xl" style="font-size: 80pt;">
                    <div class="relative flex items-center justify-center overflow-hidden italic font-bold border h-60 rounded-xl border-sidebar-border/70 dark:border-sidebar-border hover:not-italic hover:text-lime-400">
                        <h1>buy</h1>
                    </div>
                </Link>
                <div class="relative flex items-center justify-center overflow-hidden italic border h-60 rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1 class="font-bold text-orange-600 hover:text-orange-700" style="font-size: 80pt;">sell</h1>
                </div>
            </div>

            <CreateListing />

        </div>
    </AppLayout>
</template>
