<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';

const props = defineProps<{
    currentView: string;
    continent?: any;
    country?: any;
    state?: any;
    town?: any;
    resort?: any;
    category?: any;
}>();

// Sample Whistler activities data
const activities = {
    winter: [
        {
            id: 1,
            name: 'Ziptrek Ecotours',
            type: 'Ziplining',
            description: '5-line tour through old-growth forests with mountain views',
            season: 'Year-round',
            intensity: 'Moderate',
            duration: '3 hours',
            price: '$129-$159',
            image: '/images/zipline.jpg'
        },
        {
            id: 2,
            name: 'Whistler Bungee',
            type: 'Bungee Jumping',
            description: '160ft jump over glacial-fed river',
            season: 'April-November',
            intensity: 'Extreme',
            duration: '2 hours',
            price: '$139',
            image: '/images/bungee.jpg'
        }
    ],
    snow: [
        {
            id: 1,
            name: 'Cougar Mountain',
            type: 'Snowmobiling',
            description: 'Guided tours through alpine meadows',
            season: 'December-April',
            intensity: 'Moderate',
            duration: '2-4 hours',
            price: '$199-$299',
            image: '/images/snowmobile.jpg'
        },
        {
            id: 2,
            name: 'Blackcomb Helicopters',
            type: 'Heli-Skiing',
            description: 'Untouched powder in coastal ranges',
            season: 'January-March',
            intensity: 'Advanced',
            duration: 'Full day',
            price: '$1,200+',
            image: '/images/heli-ski.jpg'
        }
    ],
    yearRound: [
        {
            id: 1,
            name: 'Whistler Shooting',
            type: 'Target Sports',
            description: 'Clay pigeon shooting with expert instructors',
            season: 'Year-round',
            intensity: 'Beginner-friendly',
            duration: '1-2 hours',
            price: '$99-$199',
            image: '/images/shooting.jpg'
        },
        {
            id: 2,
            name: 'Whistler Bike Park',
            type: 'Snowshoeing',
            description: 'Guided tours through quiet forests',
            season: 'December-April',
            intensity: 'Easy',
            duration: '2-3 hours',
            price: '$79',
            image: '/images/snowshoe.jpg'
        }
    ]
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.state.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}` },
    { title: props.town.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}` },
    { title: 'Adventure Activities', href: '#' }
];
</script>

<template>
    <Head :title="`Activities - ${town?.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-blue-900 to-blue-700">
                    <h1 class="text-3xl font-bold">Adventure Activities in {{ town?.name }}</h1>
                    <p class="mt-2">From adrenaline-pumping to family-friendly adventures</p>
                </div>
            </div>

            <!-- Featured Activity -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Featured Experience</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="/images/featured-activity.jpg" alt="Featured Activity" class="object-cover w-full h-full min-h-64">
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold">Peak 2 Peak 360 Experience</h3>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span class="px-2 py-1 text-xs font-semibold text-white bg-red-600 rounded">Adrenaline</span>
                                <span class="px-2 py-1 text-xs font-semibold text-white bg-blue-600 rounded">Scenic</span>
                                <span class="px-2 py-1 text-xs font-semibold text-white bg-green-600 rounded">Family</span>
                            </div>
                            <p class="mt-3 text-gray-600 dark:text-gray-300">
                                The ultimate mountain adventure combining gondola access, suspension bridges, and panoramic views between Whistler and Blackcomb mountains.
                            </p>
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Duration</p>
                                    <p>4-5 hours</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Season</p>
                                    <p>June-October</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Difficulty</p>
                                    <p>Moderate</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Price</p>
                                    <p>$229/adult</p>
                                </div>
                            </div>
                            <button class="w-full mt-6 btn-primary">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Winter Thrills Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Winter Thrills</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="activity in activities.winter" :key="'winter-'+activity.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="activity.image" :alt="activity.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ activity.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ activity.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ activity.description }}</p>
                                <div class="grid grid-cols-2 gap-2 mt-3 text-sm">
                                    <div>
                                        <p class="text-gray-500">Season</p>
                                        <p>{{ activity.season }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Intensity</p>
                                        <p>{{ activity.intensity }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Duration</p>
                                        <p>{{ activity.duration }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Price</p>
                                        <p>{{ activity.price }}</p>
                                    </div>
                                </div>
                                <button class="w-full mt-4 btn-primary">Learn More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Snow Adventures Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Snow Adventures</h2>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div v-for="activity in activities.snow" :key="'snow-'+activity.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="activity.image" :alt="activity.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ activity.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ activity.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ activity.description }}</p>
                                <div class="grid grid-cols-2 gap-2 mt-3 text-sm">
                                    <div>
                                        <p class="text-gray-500">Season</p>
                                        <p>{{ activity.season }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Intensity</p>
                                        <p>{{ activity.intensity }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Duration</p>
                                        <p>{{ activity.duration }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Price</p>
                                        <p>{{ activity.price }}</p>
                                    </div>
                                </div>
                                <button class="w-full mt-4 btn-primary">Book Adventure</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Year-Round Activities Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Summer Adventures</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="activity in activities.yearRound" :key="'year-'+activity.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="activity.image" :alt="activity.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ activity.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ activity.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ activity.description }}</p>
                                <div class="grid grid-cols-2 gap-2 mt-3 text-sm">
                                    <div>
                                        <p class="text-gray-500">Season</p>
                                        <p>{{ activity.season }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Intensity</p>
                                        <p>{{ activity.intensity }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Duration</p>
                                        <p>{{ activity.duration }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-500">Price</p>
                                        <p>{{ activity.price }}</p>
                                    </div>
                                </div>
                                <button class="w-full mt-4 btn-outline">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Map -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Activity Locations</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="/images/activity-map.jpg" alt="Activity Map" class="object-cover w-full h-full rounded-lg">
                    </div>
                    <button class="w-full mt-4 btn-outline">View Interactive Map</button>
                </div>
            </div>

            <!-- Back Links -->
            <div class="flex flex-wrap items-center gap-2 justify-evenly">
                <Link
                    :href="`/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ town?.name }}
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.btn-primary {
    @apply px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors;
}
.btn-outline {
    @apply px-4 py-2 border rounded-lg border-sidebar-border/70 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors;
}
</style>
