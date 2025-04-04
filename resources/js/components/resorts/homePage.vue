<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
];
</script>

<template>
    <Head title="Resorts" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Main Header -->
            <div class="relative flex items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <h1 class="p-6 text-3xl font-bold">Welcome to Resorts</h1>
            </div>

            <!-- Quick Stats Row -->
            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                    <div class="group-hover:opacity-0">
                        <h1 class="text-xl">Continents</h1>
                    </div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                        <Link href="/resorts/continents" class="text-xl text-blue-400 hover:text-blue-300">View All Continents</Link>
                    </div>
                </div>

                <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1 class="text-xl">Countries</h1>
                </div>

                <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1 class="text-xl">Resorts</h1>
                </div>
            </div>

            <!-- Featured Resorts -->
            <div class="grid gap-4 md:grid-cols-1">
                <div class="p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h2 class="py-2 text-2xl text-center">Featured Resorts</h2>
                    <div class="grid gap-4 md:grid-cols-3">
                        <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                            <div class="group-hover:opacity-0">
                                <h1 class="text-xl">North America</h1>
                            </div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                                <Link href="/resorts/north-america" class="text-xl text-blue-400 hover:text-blue-300">Explore North America</Link>
                            </div>
                        </div>

                        <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                            <div class="group-hover:opacity-0">
                                <h1 class="text-xl">Europe</h1>
                            </div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                                <Link href="/resorts/europe" class="text-xl text-blue-400 hover:text-blue-300">Explore Europe</Link>
                            </div>
                        </div>

                        <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                            <div class="group-hover:opacity-0">
                                <h1 class="text-xl">Asia</h1>
                            </div>
                            <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                                <Link href="/resorts/asia" class="text-xl text-blue-400 hover:text-blue-300">Explore Asia</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="grid gap-4 md:grid-cols-1">
                <div class="p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h2 class="py-2 text-2xl text-center">Quick Links</h2>
                    <div class="flex flex-wrap justify-center gap-4">
                        <Link href="/resorts/continents" class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border">
                            View All Continents
                        </Link>
                        <Link href="/resorts/countries" class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border">
                            View All Countries
                        </Link>
                        <Link href="/resorts/all" class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border">
                            View All Resorts
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
