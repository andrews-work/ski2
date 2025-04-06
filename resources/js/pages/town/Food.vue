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

// Sample dining data - replace with your API data
const dining = {
    featured: {
        name: "Bearfoot Bistro",
        type: "Fine Dining",
        description: "Award-winning restaurant with champagne sabering and premium steak/seafood",
        highlight: "World's largest vodka ice room",
        hours: "5pm-10pm Daily",
        priceRange: "$$$$",
        image: "/images/featured-restaurant.jpg"
    },
    restaurants: [
        {
            id: 1,
            name: "Rimrock Cafe",
            type: "Seafood/Game",
            cuisine: "Pacific Northwest",
            priceRange: "$$$",
            hours: "5:30pm-10pm",
            image: "/images/restaurant1.jpg"
        },
        {
            id: 2,
            name: "Araxi",
            type: "Fine Dining",
            cuisine: "Farm-to-table",
            priceRange: "$$$$",
            hours: "5pm-11pm",
            image: "/images/restaurant2.jpg"
        }
    ],
    apres: [
        {
            id: 1,
            name: "Longhorn Saloon",
            type: "Après Bar",
            description: "Legendary slopeside party spot with live music",
            hours: "2pm-2am",
            image: "/images/apres1.jpg"
        }
    ],
    cafes: [
        {
            id: 1,
            name: "Blendz",
            type: "Coffee Shop",
            description: "Artisan coffee and breakfast sandwiches",
            hours: "6:30am-5pm",
            image: "/images/cafe1.jpg"
        }
    ],
    quickBites: [
        {
            id: 1,
            name: "Peaked Pies",
            type: "Takeout",
            description: "Australian-style meat pies",
            hours: "10am-8pm",
            image: "/images/quickbite1.jpg"
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
    { title: 'Dining & Drinks', href: '#' }
];
</script>

<template>
    <Head :title="`Dining - ${town?.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-amber-800 to-amber-600">
                    <h1 class="text-3xl font-bold">Dining & Drinks in {{ town?.name }}</h1>
                    <p class="mt-2">From slope-side apres to fine dining experiences</p>
                </div>
            </div>

            <!-- Featured Restaurant -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 bg-amber-50 dark:bg-amber-900/20">
                    <h2 class="mb-4 text-2xl font-bold">Featured Restaurant</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="relative overflow-hidden rounded-lg">
                            <img :src="dining.featured.image" :alt="dining.featured.name" class="object-cover w-full h-full min-h-64">
                        </div>
                        <div>
                            <div class="flex items-center justify-between">
                                <h3 class="text-2xl font-semibold">{{ dining.featured.name }}</h3>
                                <span class="px-2 py-1 text-sm font-semibold rounded-full text-amber-800 bg-amber-100 dark:bg-amber-900 dark:text-amber-100">
                                    {{ dining.featured.priceRange }}
                                </span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">{{ dining.featured.type }}</p>
                            <p class="mt-3 text-gray-600 dark:text-gray-300">{{ dining.featured.description }}</p>
                            <div class="p-3 mt-4 bg-white border rounded-lg dark:bg-gray-800 border-sidebar-border/30">
                                <p class="font-medium text-amber-600 dark:text-amber-400">✨ {{ dining.featured.highlight }}</p>
                            </div>
                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Hours</p>
                                    <p>{{ dining.featured.hours }}</p>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-500">Dress Code</p>
                                    <p>Smart Casual</p>
                                </div>
                            </div>
                            <button class="w-full mt-6 btn-primary">
                                <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Reserve Now
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Restaurants Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Restaurants</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="restaurant in dining.restaurants" :key="'restaurant-'+restaurant.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="restaurant.image" :alt="restaurant.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-semibold">{{ restaurant.name }}</h3>
                                    <span class="text-sm font-semibold text-amber-600">{{ restaurant.priceRange }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">{{ restaurant.type }} • {{ restaurant.cuisine }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ restaurant.hours }}
                                </div>
                                <button class="w-full mt-4 btn-outline">View Menu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Après & Bars Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Après & Bars</h2>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div v-for="bar in dining.apres" :key="'apres-'+bar.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="bar.image" :alt="bar.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ bar.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ bar.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ bar.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ bar.hours }}
                                </div>
                                <button class="w-full mt-4 btn-primary">View Specials</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cafés & Quick Bites -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Cafés</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="cafe in dining.cafes" :key="'cafe-'+cafe.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="cafe.image" :alt="cafe.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ cafe.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ cafe.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ cafe.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ cafe.hours }}
                                </div>
                                <button class="w-full mt-4 btn-outline">View Options</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Cafés & Quick Bites -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Quick Bites</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="bite in dining.quickBites" :key="'bite-'+bite.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="bite.image" :alt="bite.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ bite.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ bite.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ bite.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ bite.hours }}
                                </div>
                                <button class="w-full mt-4 btn-outline">Quick Menu</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Dining Map -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Dining Map</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="/images/dining-map.jpg" alt="Dining Map" class="object-cover w-full h-full rounded-lg">
                    </div>
                    <button class="w-full mt-4 btn-primary">
                        <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        View Interactive Dining Map
                    </button>
                </div>
            </div>

            <!-- Dietary Guide -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Dietary Guides</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="p-4 text-center border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto text-green-600 bg-green-100 rounded-full dark:bg-green-900/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-2 font-medium">Vegetarian</h3>
                            <p class="mt-1 text-sm text-gray-500">25+ options</p>
                        </div>
                        <div class="p-4 text-center border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto text-blue-600 bg-blue-100 rounded-full dark:bg-blue-900/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-2 font-medium">Vegan</h3>
                            <p class="mt-1 text-sm text-gray-500">15+ options</p>
                        </div>
                        <div class="p-4 text-center border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto rounded-full text-amber-600 bg-amber-100 dark:bg-amber-900/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-2 font-medium">Gluten-Free</h3>
                            <p class="mt-1 text-sm text-gray-500">30+ options</p>
                        </div>
                        <div class="p-4 text-center border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto text-purple-600 bg-purple-100 rounded-full dark:bg-purple-900/30">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-2 font-medium">Allergy-Friendly</h3>
                            <p class="mt-1 text-sm text-gray-500">10+ options</p>
                        </div>
                    </div>
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
    @apply px-4 py-2 text-white bg-amber-600 rounded-lg hover:bg-amber-700 transition-colors;
}
.btn-outline {
    @apply px-4 py-2 border rounded-lg border-sidebar-border/70 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors;
}
</style>
