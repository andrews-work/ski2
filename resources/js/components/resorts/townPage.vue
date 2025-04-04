<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Continent, type Country, type State, type Town, type Resort, type Category } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import InfoBar from './town/infoBar.vue';
import TownCategories from './town/categories.vue';
import Instagram from './resort/instagram.vue';
import HeroImage from './resort/heroImage.vue';
import LiveCam from './resort/liveCam.vue';
import Average from './town/average.vue';
import Reviews from './resort/reviews.vue';
import { computed, onMounted } from 'vue';

const props = defineProps<{
    continent: Continent | null;
    country: Country | null;
    state: State | null;
    towns: Town[];
    town: Town | null;
    resorts: Resort[];
    resort: Resort | null;
    categories: Category[];
}>();

// Debug logs - add these lines
console.log('Props received in TownPage:', {
    continent: props.continent,
    country: props.country,
    state: props.state,
    town: props.town,
    resorts: props.resorts,
    resort: props.resort,
    categories: props.categories
});

// Additional debug for specific problematic areas
console.log('Town slug:', props.town?.slug);
console.log('State slug:', props.state?.slug);
console.log('Country slug:', props.country?.slug);
console.log('Continent slug:', props.continent?.slug);

// This will help identify if breadcrumbs are causing issues
const breadcrumbs = computed<BreadcrumbItem[]>(() => {
    const crumbs = [
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
    ];

    console.log('Breadcrumbs generated:', crumbs);
    return crumbs;
});

// You can also add this to check after component is mounted
onMounted(() => {
    console.log('Component mounted with props:', props);
});
</script>

<template>
    <Head :title="`Resorts - ${town?.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Image Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <HeroImage :resort="resort" />
            </div>

            <!-- Info Bar Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <InfoBar
                    :continent="continent"
                    :country="country"
                    :state="state"
                    :town="town"
                    :resort="resort"
                />
            </div>

            <!-- Live Cam Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <LiveCam />
            </div>

            <!-- Average Stats Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <Average />
            </div>

            <!-- Categories Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- In your TownPage.vue template -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <TownCategories
                    :categories="categories"
                    :continent="continent"
                    :country="country"
                    :state="state"
                    :town="town"
                />
            </div>
            </div>

            <!-- Instagram Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <Instagram />
            </div>

            <!-- Reviews Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <Reviews />
            </div>

            <!-- Back Link -->
            <div class="flex items-center gap-2 justify-evenly">
                <Link
                    v-if="continent && country && state"
                    :href="`/resorts/${continent.slug}/${country.slug}/${state.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ state?.name || 'State' }}
                </Link>
                <Link
                    v-if="continent && country"
                    :href="`/resorts/${continent.slug}/${country.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ country?.name || 'Country' }}
                </Link>
                <Link
                    v-if="continent"
                    :href="`/resorts/${continent.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ continent?.name || 'Continent' }}
                </Link>
                <Link
                    href="/resorts/continents"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to All Continents
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
