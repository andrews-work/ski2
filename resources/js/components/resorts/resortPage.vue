<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import InfoBar from './resort/infoBar.vue';
import ResortCategory from './resort/resortCategory.vue';
import Instagram from './resort/instagram.vue';
import HeroImage from './resort/heroImage.vue';
import { PartyPopper, BriefcaseBusiness, Tv, ShoppingCart, Info, NotebookPen, Hotel, Martini, Building2, Utensils, CloudSun, Camera } from 'lucide-vue-next';

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
    { title: 'Ad', icon: Tv, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/Ad` },
    { title: 'Bars', icon: Martini, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/bars` },
    { title: 'Events', icon: PartyPopper, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/events` },
    { title: 'Jobs', icon: BriefcaseBusiness, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/jobs` },
    { title: 'Marketplace', icon: ShoppingCart, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/marketplace` },
    { title: 'Business', icon: Building2, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/business` },
    { title: 'Weather', icon: CloudSun, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/weather` },
    { title: 'Content', icon: Camera, link: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/content` },
];
</script>

<template>
    <Head :title="`Resorts - ${resort.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <HeroImage :resort="resort" />
        <InfoBar :resort="resort" />
        <ResortCategory :categories="categories" />

        <h1>
            have resort reviews section
        </h1>
        <h1>
            also have a section for average prices for a day weekend week fortnight- can have 4 cards each with a slideshow for different time? or have one time switch that changes all at the same time?
        </h1>
        <h1>
            plan: update infoBar to enlarge and show more info: ski day pass, current number of restaurants open 21/30
        </h1>
        <h1>
            update info component (not bat) to include a mountain section: where the user can find out about the resorts within the area like chamonix, breck
        </h1>
        <h1>
            get weather info, update infoBar
        </h1>
        <h1>
            create role middleware: guests, users, business (business can create business users), admin,
        </h1>
        <h1>
            business: user can fill out form to create business, the business can create users which are attached to the business but not a predefined user (privacy), the user can purchase adds
        </h1>
        <h1>
            make a reusable checkout componnet so i can use it for both business buying my product - adds etc. , and for the marketplace

        </h1>
        <Instagram />
    </AppLayout>
</template>
