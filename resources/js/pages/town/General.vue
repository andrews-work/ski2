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
];

const activeTab = ref('overview');

// Sample data - replace with actual data from your backend
const townInfo = {
    name: props.town?.name || 'Town Name',
    population: '8,742',
    elevation: '1,860m (6,102ft)',
    founded: '1892',
    area: '12.5 sq mi (32.4 km²)',
    timezone: 'Mountain Standard Time (MST)',
    mayor: 'Sarah Johnson',
    description: 'A charming mountain town known for its world-class skiing, vibrant arts scene, and rich mining history.',
    history: 'Founded during the silver mining boom of the late 19th century, ' + (props.town?.name || 'Town Name') + ' transformed into a premier ski destination in the 1960s. The town preserves its historic Main Street while offering modern amenities for visitors.',
    climate: 'Cold winters with heavy snowfall and mild summers. Average winter temp: -5°C (23°F), summer: 18°C (64°F).',
    economy: 'Tourism (85%), Retail (10%), Other (5%)'
};

const emergencyServices = [
    {
        name: 'Police Department',
        address: '123 Main Street',
        phone: '911 (emergency) or +1 (555) 123-4567',
        hours: '24/7',
        icon: 'shield'
    },
    {
        name: 'Fire Department',
        address: '456 Oak Avenue',
        phone: '911 (emergency) or +1 (555) 234-5678',
        hours: '24/7',
        icon: 'fire'
    },
    {
        name: 'Mountain Medical Center',
        address: '789 Pine Road',
        phone: '+1 (555) 345-6789',
        hours: '24/7 Emergency, Clinic: 8am-8pm',
        icon: 'medical'
    },
    {
        name: 'Search & Rescue',
        phone: '911 or +1 (555) 555-1212',
        hours: '24/7',
        icon: 'rescue'
    }
];

const visitorServices = [
    {
        name: 'Visitor Information Center',
        address: '100 Mountain Plaza',
        phone: '+1 (555) 987-6543',
        hours: 'Daily 8am-6pm',
        services: 'Maps, brochures, event info, trip planning'
    },
    {
        name: 'Transportation Center',
        address: '200 Transit Way',
        phone: '+1 (555) 876-5432',
        hours: 'Daily 6am-10pm',
        services: 'Bus schedules, shuttle services, taxi dispatch'
    }
];

const localGovernment = [
    {
        department: 'Town Hall',
        address: '50 Government Road',
        phone: '+1 (555) 111-2222',
        hours: 'Mon-Fri 9am-5pm'
    },
    {
        department: 'Public Works',
        address: '75 Service Lane',
        phone: '+1 (555) 222-3333',
        hours: 'Mon-Fri 7am-4pm'
    }
];

const annualEvents = [
    { name: 'Winter Festival', month: 'January', description: 'Celebration of winter with ice sculptures and live music' },
    { name: 'Founders Day', month: 'June', description: 'Historical reenactments and town parade' },
    { name: 'Autumn Arts Fair', month: 'September', description: 'Local artists and craft vendors' }
];
</script>

<template>
    <Head :title="`${townInfo.name} Information`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-blue-800 to-blue-600">
                    <h1 class="text-3xl font-bold">{{ townInfo.name }}</h1>
                    <p class="mt-2">Your complete guide to this mountain community</p>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="flex overflow-x-auto border-b border-sidebar-border/70 dark:border-sidebar-border">
                <button
                    v-for="tab in [
                        { id: 'overview', label: 'Overview' },
                        { id: 'services', label: 'Services' },
                        { id: 'government', label: 'Government' },
                        { id: 'events', label: 'Events' }
                    ]"
                    :key="tab.id"
                    @click="activeTab = tab.id"
                    :class="['px-4 py-3 text-sm font-medium whitespace-nowrap', activeTab === tab.id ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700']"
                >
                    {{ tab.label }}
                </button>
            </div>

            <!-- Content Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <!-- Overview Tab -->
                    <template v-if="activeTab === 'overview'">
                        <div class="grid gap-6 md:grid-cols-3">
                            <!-- Quick Facts -->
                            <div class="p-4 border rounded-lg border-sidebar-border/30 md:col-span-1">
                                <h2 class="mb-4 text-xl font-bold">Town Facts</h2>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Population</p>
                                        <p>{{ townInfo.population }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Elevation</p>
                                        <p>{{ townInfo.elevation }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Founded</p>
                                        <p>{{ townInfo.founded }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Area</p>
                                        <p>{{ townInfo.area }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Timezone</p>
                                        <p>{{ townInfo.timezone }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-500">Mayor</p>
                                        <p>{{ townInfo.mayor }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Description and History -->
                            <div class="p-4 border rounded-lg border-sidebar-border/30 md:col-span-2">
                                <h2 class="mb-4 text-xl font-bold">About {{ townInfo.name }}</h2>
                                <p class="mb-4">{{ townInfo.description }}</p>

                                <h3 class="mt-6 mb-2 text-lg font-semibold">History</h3>
                                <p class="mb-4">{{ townInfo.history }}</p>

                                <h3 class="mt-6 mb-2 text-lg font-semibold">Climate</h3>
                                <p class="mb-4">{{ townInfo.climate }}</p>

                                <h3 class="mt-6 mb-2 text-lg font-semibold">Economy</h3>
                                <p>{{ townInfo.economy }}</p>
                            </div>
                        </div>
                    </template>

                    <!-- Services Tab -->
                    <template v-else-if="activeTab === 'services'">
                        <h2 class="mb-6 text-2xl font-bold">Emergency Services</h2>
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div v-for="service in emergencyServices" :key="service.name" class="p-4 border rounded-lg border-sidebar-border/30">
                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-10 h-10 mt-1 mr-4 text-white rounded-full"
                                         :class="{
                                             'bg-blue-600': service.icon === 'shield',
                                             'bg-red-600': service.icon === 'fire',
                                             'bg-green-600': service.icon === 'medical',
                                             'bg-orange-600': service.icon === 'rescue'
                                         }">
                                        <svg v-if="service.icon === 'shield'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                        <svg v-if="service.icon === 'fire'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.879 16.121A3 3 0 1012.015 11L11 14H9c0 .768.293 1.536.879 2.121z" />
                                        </svg>
                                        <svg v-if="service.icon === 'medical'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        <svg v-if="service.icon === 'rescue'" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold">{{ service.name }}</h3>
                                        <p v-if="service.address" class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            <span class="font-medium">Address:</span> {{ service.address }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            <span class="font-medium">Phone:</span> {{ service.phone }}
                                        </p>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                            <span class="font-medium">Hours:</span> {{ service.hours }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h2 class="mt-12 mb-6 text-2xl font-bold">Visitor Services</h2>
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div v-for="service in visitorServices" :key="service.name" class="p-4 border rounded-lg border-sidebar-border/30">
                                <h3 class="text-lg font-semibold">{{ service.name }}</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    <span class="font-medium">Address:</span> {{ service.address }}
                                </p>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    <span class="font-medium">Phone:</span> {{ service.phone }}
                                </p>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    <span class="font-medium">Hours:</span> {{ service.hours }}
                                </p>
                                <p class="mt-2 text-sm">
                                    <span class="font-medium">Services:</span> {{ service.services }}
                                </p>
                            </div>
                        </div>
                    </template>

                    <!-- Government Tab -->
                    <template v-else-if="activeTab === 'government'">
                        <h2 class="mb-6 text-2xl font-bold">Local Government</h2>
                        <div class="grid gap-6 sm:grid-cols-2">
                            <div v-for="office in localGovernment" :key="office.department" class="p-4 border rounded-lg border-sidebar-border/30">
                                <h3 class="text-lg font-semibold">{{ office.department }}</h3>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    <span class="font-medium">Address:</span> {{ office.address }}
                                </p>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    <span class="font-medium">Phone:</span> {{ office.phone }}
                                </p>
                                <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">
                                    <span class="font-medium">Hours:</span> {{ office.hours }}
                                </p>
                                <button class="w-full mt-4 btn-outline">Visit Website</button>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-3">
                            <div class="p-4 border rounded-lg border-sidebar-border/30">
                                <h3 class="text-lg font-semibold">Town Council</h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                    Next meeting: January 15, 2024 at 6pm
                                </p>
                                <button class="w-full mt-4 btn-outline">View Agenda</button>
                            </div>
                            <div class="p-4 border rounded-lg border-sidebar-border/30">
                                <h3 class="text-lg font-semibold">Public Notices</h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                    Current road closures and announcements
                                </p>
                                <button class="w-full mt-4 btn-outline">View Notices</button>
                            </div>
                            <div class="p-4 border rounded-lg border-sidebar-border/30">
                                <h3 class="text-lg font-semibold">Permits & Licenses</h3>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">
                                    Business licenses, building permits, etc.
                                </p>
                                <button class="w-full mt-4 btn-outline">Apply Online</button>
                            </div>
                        </div>
                    </template>

                    <!-- Events Tab -->
                    <template v-else-if="activeTab === 'events'">
                        <h2 class="mb-6 text-2xl font-bold">Annual Events</h2>
                        <div class="space-y-6">
                            <div v-for="event in annualEvents" :key="event.name" class="p-4 border rounded-lg border-sidebar-border/30">
                                <div class="flex items-start">
                                    <div class="flex items-center justify-center w-12 h-12 mr-4 text-white bg-blue-600 rounded-full">
                                        {{ event.month.slice(0, 3) }}
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-semibold">{{ event.name }}</h3>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">{{ event.description }}</p>
                                        <button class="mt-3 btn-outline">Event Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 mt-6 border rounded-lg border-sidebar-border/30">
                            <h3 class="text-lg font-semibold">Community Calendar</h3>
                            <p class="mt-2 text-gray-600 dark:text-gray-300">
                                View all upcoming events, meetings, and activities in {{ townInfo.name }}
                            </p>
                            <button class="w-full mt-4 btn-primary">View Full Calendar</button>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Back Links -->
            <div class="flex flex-wrap items-center gap-2 justify-evenly">
                <Link
                    :href="`/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ state?.name || 'State' }}
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
