<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Category, type Continent, type Resort, type Country } from '@/types';
import { Head } from '@inertiajs/vue3';
import InfoBar from './resort/infoBar.vue';
import ResortCategory from './resort/resortCategory.vue';
import Instagram from './resort/instagram.vue';
import HeroImage from './resort/heroImage.vue';
import LiveCam from './resort/liveCam.vue';
import Average from './resort/average.vue';
import Reviews from './resort/reviews.vue';
import { PartyPopper, BriefcaseBusiness, ShoppingCart, Info, NotebookPen, Hotel, Martini, Building2, Utensils, CloudSun, Camera, Dumbbell } from 'lucide-vue-next';

const props = defineProps<{
    continent: Continent;
    country: Country;
    resort: Resort;
    categories: Category[];
}>();

console.log('Resort Object:', props.categories);

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
];

</script>

<template>
    <Head :title="`Resorts - ${resort.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <HeroImage :resort="resort" />
        <InfoBar :resort="resort" />
        <ResortCategory :categories="categories" :continent="continent" :country="country" :resort="resort" />
        <LiveCam />
        <Average />
        <Instagram />
        <Reviews />
    </AppLayout>
</template>
