<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import HeroImage from '@/components/resorts/resort/heroImage.vue';
import InfoBar from '@/components/resorts/town/infoBar.vue';
import LiveCam from '@/components/resorts/resort/liveCam.vue';
import Reviews from '@/components/resorts/resort/reviews.vue';

// Fake data for testing
const fakeResort = {
    id: 1,
    name: 'Whistler Blackcomb',
    slug: 'whistler-blackcomb',
    town: {
        name: 'Whistler',
        slug: 'whistler'
    },
    distance: 0
};

const fakeNearbyResorts = {
    within10km: [
        {
            id: 2,
            name: 'Whistler Olympic Park',
            slug: 'whistler-olympic-park',
            town: {
                name: 'Whistler',
                slug: 'whistler'
            },
            distance: 8
        }
    ],
    within50km: [
        {
            id: 3,
            name: 'Cypress Mountain',
            slug: 'cypress-mountain',
            town: {
                name: 'West Vancouver',
                slug: 'west-vancouver'
            },
            distance: 45
        }
    ],
    within100km: [
        {
            id: 4,
            name: 'Grouse Mountain',
            slug: 'grouse-mountain',
            town: {
                name: 'North Vancouver',
                slug: 'north-vancouver'
            },
            distance: 75
        },
        {
            id: 5,
            name: 'Mount Seymour',
            slug: 'mount-seymour',
            town: {
                name: 'North Vancouver',
                slug: 'north-vancouver'
            },
            distance: 85
        }
    ]
};

const fakeLocationData = {
    continent: {
        name: 'North America',
        slug: 'north-america'
    },
    country: {
        name: 'Canada',
        slug: 'canada'
    },
    state: {
        name: 'British Columbia',
        slug: 'british-columbia'
    },
    town: {
        name: 'Whistler',
        slug: 'whistler'
    },
    resort: fakeResort
};

const props = defineProps<{
    currentView?: string;
    continent?: any;
    country?: any;
    state?: any;
    town?: any;
    resort?: any;
    category?: any;
    nearbyResorts?: {
        within10km: any[];
        within50km: any[];
        within100km: any[];
    };
}>();

// Use fake data if props are not provided
const continent = props.continent || fakeLocationData.continent;
const country = props.country || fakeLocationData.country;
const state = props.state || fakeLocationData.state;
const town = props.town || fakeLocationData.town;
const resort = props.resort || fakeLocationData.resort;
const nearbyResorts = props.nearbyResorts || fakeNearbyResorts;

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: continent.name, href: `/resorts/${continent.slug}` },
    { title: country.name, href: `/resorts/${continent.slug}/${country.slug}` },
    { title: state.name, href: `/resorts/${continent.slug}/${country.slug}/${state.slug}` },
    { title: town.name, href: `/resorts/${continent.slug}/${country.slug}/${state.slug}/${town.slug}` },
    { title: 'Resorts', href: `/resorts/${continent.slug}/${country.slug}/${state.slug}/${town.slug}/resorts` },
];
</script>

<template>
    <Head :title="`${resort.name} - ${town.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Image Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <HeroImage :resort="resort" />
            </div>

            <!-- Nearby Resorts Sections -->
            <div v-if="nearbyResorts.within10km.length > 0" class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-4 text-xl font-bold">Resorts within 10km</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                        <Link
                            v-for="nearbyResort in nearbyResorts.within10km"
                            :key="nearbyResort.id"
                            :href="`/resorts/${continent.slug}/${country.slug}/${state.slug}/${town.slug}/${resort.slug}`"
                            class="p-4 transition-colors duration-200 border rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 border-sidebar-border/70 dark:border-sidebar-border"
                        >
                            <h3 class="font-semibold">{{ nearbyResort.name }}</h3>
                            <p class="text-sm text-gray-500">{{ nearbyResort.town.name }}</p>
                            <p class="text-xs text-gray-400">{{ nearbyResort.distance }} km away</p>
                        </Link>
                    </div>
                </div>
            </div>

            <div v-if="nearbyResorts.within50km.length > 0" class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-4 text-xl font-bold">Resorts within 50km</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                        <Link
                            v-for="nearbyResort in nearbyResorts.within50km"
                            :key="nearbyResort.id"
                            :href="`/resorts/${continent.slug}/${country.slug}/${state.slug}/${nearbyResort.town.slug}/${nearbyResort.slug}`"
                            class="p-4 transition-colors duration-200 border rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 border-sidebar-border/70 dark:border-sidebar-border"
                        >
                            <h3 class="font-semibold">{{ nearbyResort.name }}</h3>
                            <p class="text-sm text-gray-500">{{ nearbyResort.town.name }}</p>
                            <p class="text-xs text-gray-400">{{ nearbyResort.distance }} km away</p>
                        </Link>
                    </div>
                </div>
            </div>

            <div v-if="nearbyResorts.within100km.length > 0" class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-4 text-xl font-bold">Resorts within 100km</h2>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3">
                        <Link
                            v-for="nearbyResort in nearbyResorts.within100km"
                            :key="nearbyResort.id"
                            :href="`/resorts/${continent.slug}/${country.slug}/${state.slug}/${nearbyResort.town.slug}/${nearbyResort.slug}`"
                            class="p-4 transition-colors duration-200 border rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 border-sidebar-border/70 dark:border-sidebar-border"
                        >
                            <h3 class="font-semibold">{{ nearbyResort.name }}</h3>
                            <p class="text-sm text-gray-500">{{ nearbyResort.town.name }}</p>
                            <p class="text-xs text-gray-400">{{ nearbyResort.distance }} km away</p>
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Live Cam Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <LiveCam />
            </div>

            <!-- Reviews Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <Reviews />
            </div>

            <!-- Back Link -->
            <div class="flex items-center gap-2 justify-evenly">
                <Link
                    :href="`/resorts/${continent.slug}/${country.slug}/${state.slug}/${town.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ town.name }}
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
