<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{
    continent: any;
    countries: Array<any>;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents'},
    { title: props.continent.name, href: `${props.continent.slug}` },
];
</script>

<template>
    <Head title="Resorts - Country select" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4 rounded-xl">
            <h1>Country List</h1>
            <ul>
                <li v-for="country in countries" :key="country.id">
                    <Link :href="`/resorts/${continent.slug}/${country.slug}`" class="text-blue-500">
                        {{ country.name }}
                    </Link>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>