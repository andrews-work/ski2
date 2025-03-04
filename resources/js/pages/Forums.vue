<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import CategoryList from '@/components/forums/CategoryList.vue';

defineProps({
    categories: {
        type: Array,
        required: true,
    },
    subcategories: {
        type: Array,
        required: true,
    },
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Forums',
        href: '/forums',
    },
];
</script>

<template>
    <Head title="Forums" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1>most active threads (top 3?)</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1>hello</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1>hello</h1>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <div class="relative col-span-2 border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <CategoryList :categories="categories" :subcategories="subcategories" />
                </div>
                <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1>postList</h1>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

