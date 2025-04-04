<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Category, type State, type Town, type Continent, type Resort, type Country } from '@/types';
import { Head } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{
    continent?: Continent | null;
    country?: Country | null;
    resort?: Resort | null;
    state?: State | null;
    town?: Town | null;
    categories?: Category[];
}>();

console.log('Resort Object:', props.categories);

const breadcrumbs = computed<BreadcrumbItem[]>(() => [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    {
        title: props.continent?.name || 'Continent',
        href: props.continent ? `/resorts/${props.continent.slug}` : '#'
    },
    {
        title: props.country?.name || 'Country',
        href: props.continent && props.country ?
            `/resorts/${props.continent.slug}/${props.country.slug}` : '#'
    },
    {
        title: props.state?.name || 'State',
        href: props.continent && props.country && props.state ?
            `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}` : '#'
    },
    {
        title: props.town?.name || 'Town',
        href: props.continent && props.country && props.state && props.town ?
            `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}` : '#'
    },
    {
        title: props.resort?.name || 'resort',
        href: props.continent && props.country && props.state && props.town  && props.resort?
            `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}/${props.resort.slug}` : '#'
    },
]);

</script>

<template>
    <Head :title="`Resorts - ${resort?.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <h1>figure out what i want here first</h1>
    </AppLayout>
</template>
