<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    continent: any;
    country: any;
    resorts: any;
    categories: any;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
];
</script>

<template>
    <Head title="Resorts - Resort List" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4 rounded-xl">
            <h1>Resort List</h1>
            <ul>
                <li v-for="resort in resorts" :key="resort.id">
                    <Link :href="`/resorts/${continent.slug}/${country.slug}/${resort.slug}`" class="text-blue-500">
                        {{ resort.name }}
                    </Link>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
