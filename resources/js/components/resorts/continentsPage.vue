<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts ',href: '/resorts' },
    { title: 'continents',href: '/resorts/continents' },
];

defineProps<{
    continents: Array<any>;
}>();

</script>

<template>
    <Head title="Resorts - Reigon select" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4 rounded-xl">
        <h1>Continents List</h1>
        <ul>
            <li v-for="continent in continents" :key="continent.id">
                <Link :href="`/resorts/${continent.slug}`" class="text-blue-500">
                    {{ continent.name }}
                </Link>
            </li>
        </ul>
    </div>
    </AppLayout>
</template>
