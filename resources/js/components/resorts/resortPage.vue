<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import InfoBar from './resort/infoBar.vue';
import ResortCategory from './resort/resortCategory.vue';
import Instagram from './resort/instagram.vue';
import HeroImage from './resort/heroImage.vue';
import { PartyPopper, BriefcaseBusiness, ShoppingCart, Info, NotebookPen, Hotel, Martini, Building2, Utensils, CloudSun } from 'lucide-vue-next';

const props = defineProps<{
    continent: any;
    country: any;
    resort: any;
}>();

console.log('Resort Object:', props.resort);

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
];

const categories = [
    { title: 'Info', icon: Info, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/info` },
    { title: 'Hotels', icon: Hotel, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/hotels` },
    { title: 'Restaurants', icon: Utensils, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/restaurants` },
    { title: 'Forums', icon: NotebookPen, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/forums` },
    { title: 'Bars', icon: Martini, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/bars` },
    { title: 'Events', icon: PartyPopper, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/events` },
    { title: 'Jobs', icon: BriefcaseBusiness, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/jobs` },
    { title: 'Marketplace', icon: ShoppingCart, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/marketplace` },
    { title: 'Businesses', icon: Building2, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/businesses` },
    { title: 'Weather', icon: CloudSun, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/weather` },
];
</script>

<template>
    <Head :title="`Resorts - ${resort.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <HeroImage :resort="resort" />
        <InfoBar :resort="resort" />
        <ResortCategory :categories="categories" />
        <Instagram />
    </AppLayout>
</template>
