<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ListIcon, GridIcon } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
    currentView: string;
    continent: any;
    country: any;
    resort: any;
    debug?: boolean;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
    { title: 'Jobs', href: '' },
];
</script>

<template>
    <Head title="Jobs" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="currentView === 'jobs'" class="p-4 text-white">
            <h1>
                list jobs in resort<br>

                can search by category - company - level
            </h1>
        </div>
    </AppLayout>
</template>
