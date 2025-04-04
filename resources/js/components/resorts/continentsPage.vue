<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { type Continent } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
];

defineProps<{
    continents: Continent[];
}>();
</script>

<template>
    <Head title="Resorts - Region Select" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Main Header -->
            <div class="relative flex items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <h1 class="p-6 text-3xl font-bold">Continents List</h1>
            </div>

            <!-- Continents Grid -->
            <div class="grid gap-4 auto-rows-min md:grid-cols-2 lg:grid-cols-3">
                <div
                    v-for="continent in continents"
                    :key="continent.id"
                    class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
                >
                    <!-- Visible content -->
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 group-hover:opacity-0">
                        <h2 class="text-2xl font-medium text-center">{{ continent.name }}</h2>
                    </div>

                    <!-- Hover content -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                        <Link
                            :href="`/resorts/${continent.slug}`"
                            class="px-6 py-3 text-xl font-medium transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700"
                        >
                            Explore {{ continent.name }}
                        </Link>
                        <p class="mt-4 text-center text-gray-300">
                            {{ continent.count }} countries
                        </p>
                    </div>
                </div>
            </div>

            <!-- Back Link -->
            <div class="flex justify-center mt-4">
                <Link
                    href="/resorts"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to Resorts
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
