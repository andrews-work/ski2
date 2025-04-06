<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ref } from 'vue';

const props = defineProps<{
    currentView: string;
    continent?: any;
    country?: any;
    state?: any;
    town?: any;
    resort?: any;
    category?: any;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.state.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}` },
    { title: props.town.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}` },
    { title: props.category.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}/${props.category.slug}` },
];

// Sample data
const rentalCompanies = ref([
    {
        id: 1,
        name: 'Mountain Ski Rentals',
        description: 'Premium ski and snowboard rentals with the latest equipment',
        types: ['Ski', 'Snowboard', 'Poles', 'Boots'],
        priceRange: '$40-$120/day',
        image: '/images/ski-rental.jpg',
        rating: 4.7,
        location: '123 Mountain Road'
    },
    {
        id: 2,
        name: 'Alpine Car Rentals',
        description: 'Reliable vehicles for all your mountain adventures',
        types: ['Car', 'SUV', 'Van'],
        priceRange: '$80-$200/day',
        image: '/images/car-rental.jpg',
        rating: 4.3,
        location: 'Resort Village Center'
    }
]);

const rentalTypes = [
    {
        id: 1,
        name: 'Ski Equipment',
        description: 'Rent skis, poles, and boots for your mountain adventure',
        icon: 'ski',
        averagePrice: '$50/day',
        image: '/images/ski-type.jpg'
    },
    {
        id: 2,
        name: 'Snowboard Gear',
        description: 'Quality snowboards and boots for all levels',
        icon: 'snowboard',
        averagePrice: '$45/day',
        image: '/images/snowboard-type.jpg'
    },
    {
        id: 3,
        name: 'Winter Clothing',
        description: 'Stay warm with our jacket and pants rentals',
        icon: 'clothing',
        averagePrice: '$30/day',
        image: '/images/clothing-type.jpg'
    },
    {
        id: 4,
        name: 'Vehicle Rentals',
        description: 'Cars, SUVs and vans for getting around',
        icon: 'car',
        averagePrice: '$100/day',
        image: '/images/car-type.jpg'
    }
];

const submitRental = () => {
    // Implement the logic to submit a new rental
    console.log('Rental submitted');
};
</script>

<template>
    <Head title="Rentals Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Main Heading -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h1 class="text-3xl font-bold">Rentals in {{ town?.name }}</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Find all the equipment and vehicles you need for your mountain adventure</p>
                </div>
            </div>

            <!-- Rental Companies Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Rental Companies</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div v-for="company in rentalCompanies" :key="company.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="company.image" :alt="company.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-semibold">{{ company.name }}</h3>
                                    <div class="flex items-center">
                                        <span class="mr-1 font-semibold">{{ company.rating }}</span>
                                        <svg v-for="i in 5" :key="i" class="w-4 h-4" :class="i <= company.rating ? 'text-yellow-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ company.description }}</p>
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-500">Location</p>
                                    <p>{{ company.location }}</p>
                                </div>
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-500">Rental Types</p>
                                    <div class="flex flex-wrap gap-1 mt-1">
                                        <span v-for="type in company.types" :key="type" class="px-2 py-1 text-xs bg-gray-100 rounded dark:bg-gray-700">{{ type }}</span>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <p class="text-sm font-medium text-gray-500">Price Range</p>
                                    <p>{{ company.priceRange }}</p>
                                </div>
                                <button class="w-full mt-4 btn-primary">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rental Types Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Rental Types</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div v-for="type in rentalTypes" :key="type.id" class="p-4 border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center justify-center w-12 h-12 mx-auto mb-3 text-white bg-blue-600 rounded-full">
                                <svg v-if="type.icon === 'ski'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                                <svg v-if="type.icon === 'snowboard'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <svg v-if="type.icon === 'clothing'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                                </svg>
                                <svg v-if="type.icon === 'car'" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-center">{{ type.name }}</h3>
                            <p class="mt-2 text-sm text-center text-gray-600 dark:text-gray-300">{{ type.description }}</p>
                            <div class="mt-4 text-center">
                                <p class="text-sm font-medium text-gray-500">Average Price</p>
                                <p class="font-semibold">{{ type.averagePrice }}</p>
                            </div>
                            <button class="w-full mt-4 btn-outline">Browse Options</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Rentals Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Rent from Locals</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="p-4 border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 mr-4 text-white bg-green-600 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold">List Your Gear</h3>
                                    <p class="text-gray-600 dark:text-gray-300">Earn money by renting out your equipment when you're not using it</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button @click="submitRental" class="w-full btn-primary">List Your Rental</button>
                            </div>
                        </div>
                        <div class="p-4 border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 mr-4 text-white bg-blue-600 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold">Community Rentals</h3>
                                    <p class="text-gray-600 dark:text-gray-300">Browse equipment available from local community members</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button class="w-full btn-outline">View Community Rentals</button>
                            </div>
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
    @apply px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors;
}
.btn-outline {
    @apply px-4 py-2 border rounded-lg border-sidebar-border/70 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors;
}
</style>
