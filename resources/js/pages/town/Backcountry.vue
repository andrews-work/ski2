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
    backcountry?: any;
    category: any;
}>();

const showSafetyModal = ref(true);
const isAuthenticated = ref(false); // Would come from auth store in real app

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.state.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}` },
    { title: props.town.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}` },
    { title: props.category.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}/${props.category.slug}` },
];

// Sample data - replace with your actual data
const heliOperators = [
    {
        id: 1,
        name: 'Alpine Heli-Skiing',
        description: 'Premier helicopter skiing with 300,000 acres of terrain',
        terrain: 'Advanced/Expert',
        price: '$1,200-$2,500/day',
        image: '/images/heli1.jpg'
    },
    {
        id: 2,
        name: 'Powder Cats',
        description: 'Cat skiing with small groups and deep powder',
        terrain: 'Intermediate/Advanced',
        price: '$600-$900/day',
        image: '/images/cat1.jpg'
    }
];

const entryPoints = [
    { id: 1, name: 'North Ridge', difficulty: 'Advanced', elevation: '2,800m', approach: '1.5h hike' },
    { id: 2, name: 'Valley Access', difficulty: 'Intermediate', elevation: '2,100m', approach: '30m hike' },
    { id: 3, name: 'East Bowl', difficulty: 'Expert', elevation: '3,100m', approach: '2h hike' },
    { id: 4, name: 'West Face', difficulty: 'Advanced', elevation: '2,900m', approach: '1h hike' }
];

const gearShops = [
    { id: 1, name: 'Backcountry Pros', specialties: 'Beacons, probes, airbags', location: 'Downtown' },
    { id: 2, name: 'Mountain Gear', specialties: 'Skis, splitboards, boots', location: 'Resort Village' }
];

const safetyAcknowledgement = () => {
    isAuthenticated.value = true; // In real app, would check auth status
    showSafetyModal.value = false;
};
</script>

<template>
    <Head :title="`Backcountry - ${town?.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Safety Modal -->
        <div v-if="showSafetyModal && !isAuthenticated" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70">
            <div class="w-full max-w-2xl p-6 mx-4 bg-white rounded-lg dark:bg-gray-800">
                <h2 class="mb-4 text-2xl font-bold text-red-600">Backcountry Safety Acknowledgement</h2>
                <div class="prose dark:prose-invert max-h-[60vh] overflow-y-auto">
                    <p class="mb-4">Backcountry skiing and riding involves significant risk. By accessing this information, you acknowledge that:</p>
                    <ul class="pl-5 mb-4 list-disc">
                        <li>You understand the dangers of avalanche terrain</li>
                        <li>You have proper training and equipment</li>
                        <li>You will check current avalanche forecasts</li>
                        <li>You are solely responsible for your safety decisions</li>
                        <li>This information may be incomplete or inaccurate</li>
                    </ul>
                    <p>You must <Link href="/register" class="text-blue-500 underline">create an account</Link> or <Link href="/login" class="text-blue-500 underline">log in</Link> to access backcountry information.</p>
                </div>
                <div class="flex justify-end mt-6 space-x-4">
                    <Link href="/" class="px-4 py-2 border rounded-lg border-sidebar-border/70">Cancel</Link>
                    <button @click="safetyAcknowledgement" class="px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">
                        I Understand & Accept
                    </button>
                </div>
            </div>
        </div>

        <div v-if="isAuthenticated" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Safety Banner -->
            <div class="relative overflow-hidden border border-red-600 rounded-xl">
                <div class="p-4 bg-red-100 dark:bg-red-900/30">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <h3 class="font-bold text-red-600">Current Avalanche Danger: <span class="font-normal">Considerable (Level 3)</span></h3>
                    </div>
                    <p class="mt-2 text-sm">Always check the <a href="#" class="underline">local avalanche forecast</a> before touring.</p>
                </div>
            </div>

            <!-- Main Heading -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h1 class="text-3xl font-bold">Backcountry Areas Near {{ town?.name }}</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Explore the best backcountry terrain with safety information and local resources</p>
                </div>
            </div>

            <!-- Heli/Cat Skiing Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Heli Skiing & Cat Skiing</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div v-for="operator in heliOperators" :key="operator.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="operator.image" :alt="operator.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ operator.name }}</h3>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ operator.description }}</p>
                                <div class="grid grid-cols-2 gap-2 mt-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Terrain</p>
                                        <p>{{ operator.terrain }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Price</p>
                                        <p>{{ operator.price }}</p>
                                    </div>
                                </div>
                                <button class="w-full mt-4 btn-primary">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Entry Points Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Backcountry Entry Points</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div v-for="point in entryPoints" :key="point.id" class="p-4 border rounded-lg border-sidebar-border/30">
                            <h3 class="text-lg font-semibold">{{ point.name }}</h3>
                            <div class="grid grid-cols-2 gap-2 mt-3 text-sm">
                                <div>
                                    <p class="text-gray-500">Difficulty</p>
                                    <p>{{ point.difficulty }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Elevation</p>
                                    <p>{{ point.elevation }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-gray-500">Approach</p>
                                    <p>{{ point.approach }}</p>
                                </div>
                            </div>
                            <button class="w-full mt-3 btn-outline">View Map</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- In-Bounds Backcountry Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">In-Bounds Backcountry Areas</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="p-4 border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 mr-4 text-white bg-blue-600 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold">Resort-Controlled Gates</h3>
                                    <p class="text-gray-600 dark:text-gray-300">Access requires avalanche gear and wristband</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button class="btn-primary">View Gate Policy</button>
                            </div>
                        </div>
                        <div class="p-4 border rounded-lg border-sidebar-border/30">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center w-12 h-12 mr-4 text-white bg-green-600 rounded-full">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold">Uphill Access Routes</h3>
                                    <p class="text-gray-600 dark:text-gray-300">Designated skin tracks within resort boundaries</p>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button class="btn-primary">View Uphill Policy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back Links -->
            <div class="flex flex-wrap items-center gap-2 justify-evenly">
                <Link
                    v-if="continent && country && state"
                    :href="`/backcountry/${continent.slug}/${country.slug}/${state.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ state?.name || 'State' }} Backcountry
                </Link>
                <!-- Other back links -->
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
