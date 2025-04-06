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

// Sample transport data - replace with your API data
const transport = {
    featured: {
        name: "Sea to Sky Shuttle",
        type: "Shuttle Service",
        description: "Direct shuttle service from Vancouver to Whistler",
        highlight: "Comfortable and scenic ride",
        hours: "Daily departures",
        priceRange: "$$",
        image: "/images/featured-transport.jpg"
    },
    taxis: [
        {
            id: 1,
            name: "Whistler Taxi",
            type: "Taxi Service",
            priceRange: "$$",
            hours: "24/7",
            image: "/images/taxi1.jpg"
        },
        {
            id: 2,
            name: "Resort Cabs",
            type: "Taxi Service",
            priceRange: "$$",
            hours: "24/7",
            image: "/images/taxi2.jpg"
        }
    ],
    buses: [
        {
            id: 1,
            name: "Whistler Transit",
            type: "Local Bus",
            description: "Regular bus service around Whistler",
            hours: "6am-11pm",
            image: "/images/bus1.jpg"
        }
    ],
    parking: [
        {
            id: 1,
            name: "Day Lots 1-3",
            type: "Parking Lot",
            description: "Main parking lots in Whistler Village",
            hours: "24/7",
            image: "/images/parking1.jpg"
        }
    ],
    gettingTo: [
        {
            id: 1,
            name: "Greyhound Bus",
            type: "Bus Service",
            description: "Bus service from Vancouver to Whistler",
            hours: "Multiple daily departures",
            image: "/images/gettingto1.jpg"
        },
        {
            id: 2,
            name: "Whistler Train Station",
            type: "Train Service",
            description: "Train service to Whistler",
            hours: "Limited departures",
            image: "/images/gettingto2.jpg"
        },
        {
            id: 3,
            name: "Private Car",
            type: "Private Transport",
            description: "Hire a private car to Whistler",
            hours: "Flexible",
            image: "/images/gettingto3.jpg"
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
    { title: 'Transport', href: '#' }
];
</script>

<template>
    <Head :title="`Transport - ${town?.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-blue-800 to-blue-600">
                    <h1 class="text-3xl font-bold">Transport in {{ town?.name }}</h1>
                    <p class="mt-2">From taxis to buses and parking options</p>
                </div>
            </div>

            <!-- Featured Transport -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 bg-blue-50 dark:bg-blue-900/20">
                    <h2 class="mb-4 text-2xl font-bold">Featured Transport</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="relative overflow-hidden rounded-lg">
                            <img :src="transport.featured.image" :alt="transport.featured.name" class="object-cover w-full h-full min-h-64">
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="text-2xl font-semibold">{{ transport.featured.name }}</h3>
                                <span class="px-2 py-1 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-100">
                                    {{ transport.featured.priceRange }}
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">{{ transport.featured.type }}</p>
                            <p class="mt-3 text-gray-600 dark:text-gray-300">{{ transport.featured.description }}</p>
                            <div class="p-3 mt-4 bg-white border rounded-lg dark:bg-gray-800 border-sidebar-border/30">
                                <p class="font-medium text-blue-600 dark:text-blue-400">✨ {{ transport.featured.highlight }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Hours</p>
                                    <p>{{ transport.featured.hours }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Reservations</p>
                                    <p>Recommended</p>
                                </div>
                            </div>
                            <button class="w-full mt-6 btn-primary">
                                <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Book Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Taxis Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Taxis</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="taxi in transport.taxis" :key="'taxi-'+taxi.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="taxi.image" :alt="taxi.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-semibold">{{ taxi.name }}</h3>
                                    <span class="text-sm font-semibold text-blue-600">{{ taxi.priceRange }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">{{ taxi.type }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ taxi.hours }}
                                </div>
                                <button class="w-full mt-4 btn-outline">Call Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buses Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Local Bus Schedule</h2>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div v-for="bus in transport.buses" :key="'bus-'+bus.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="bus.image" :alt="bus.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ bus.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ bus.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ bus.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ bus.hours }}
                                </div>
                                <button class="w-full mt-4 btn-primary">View Schedule</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parking Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Parking</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="park in transport.parking" :key="'park-'+park.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="park.image" :alt="park.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ park.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ park.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ park.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ park.hours }}
                                </div>
                                <button class="w-full mt-4 btn-outline">View Map</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Getting To Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Getting To Whistler</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="option in transport.gettingTo" :key="'option-'+option.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="option.image" :alt="option.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ option.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ option.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ option.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ option.hours }}
                                </div>
                                <button class="w-full mt-4 btn-primary">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Parking Map -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Parking Map</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="/images/parking-map.jpg" alt="Parking Map" class="object-cover w-full h-full rounded-lg">
                    </div>
                    <button class="w-full mt-4 btn-primary">
                        <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        View Interactive Parking Map
                    </button>
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
