<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Marketplace',
        href: '/marketplace',
    },
];
</script>

<template>
    <Head title="Marketplace" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1>hello</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1>hello</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                    <h1>hello</h1>
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <h1>hello</h1>
            </div>
        </div>
    </AppLayout>
</template>


<!-- components -->

<!--
- history
- sell
- categories list
- category page

-->


<!-- pages -->
<!--

- marketplace
- pay form (if guest, ask if they want to create an account with email)
-->



<!-- needs -->
<!--

- sell button

- categories
    - skis
    - snowboards
    - boots
    - jackets
    - pants
    - goggles
    - hoodies
    - poles
    - backpacks
    - avi gear
- shopping cart modal
- view cart (login to buy)
- pay form - multistep
    - address
    - pay
    - confirm
        - email invoice
- if logged in, show history
    - wishlist
    - ordered
    - complete orders



-->

