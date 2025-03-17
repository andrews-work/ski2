<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '@/components/app/PlaceholderPattern.vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Casino',
        href: '/casino',
    },
];
</script>

<template>
    <Head title="Casino" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1></h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>

<!-- needs

add funds
remove funds



-->



<!-- casino

policy
terms and conditions
house always wins


-->
