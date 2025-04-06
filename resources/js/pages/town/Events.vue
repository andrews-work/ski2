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

const events = ref([
    { id: 1, name: 'Ski Festival', date: '2024-12-01', location: 'Whistler', description: 'Annual ski festival with competitions and entertainment.', image: '/images/event1.jpg' },
    { id: 2, name: 'Wine Tasting', date: '2024-11-15', location: 'Whistler', description: 'Exclusive wine tasting event with local vineyards.', image: '/images/event2.jpg' },
    { id: 3, name: 'Music Festival', date: '2024-11-20', location: 'Whistler', description: 'Outdoor music festival featuring local and international artists.', image: '/images/event3.jpg' },
    { id: 4, name: 'Art Exhibition', date: '2024-11-25', location: 'Whistler', description: 'Showcasing local artists and their work.', image: '/images/event4.jpg' }
]);

const selectedEvent = ref(null);

const viewEvent = (event) => {
    selectedEvent.value = event;
};

const createEvent = () => {
    // Navigate to event creation page or open a modal
    console.log('Create Event');
};
</script>

<template>
    <Head title="Events Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-orange-800 to-orange-600">
                    <h1 class="text-3xl font-bold">Events in {{ town?.name }}</h1>
                    <p class="mt-2">Explore upcoming events and activities</p>
                </div>
            </div>

            <!-- Event Listings -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Event Listings</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="event in events" :key="event.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="event.image" :alt="event.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ event.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ event.date }} • {{ event.location }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ event.description }}</p>
                                <button @click="viewEvent(event)" class="w-full mt-4 btn-primary">View Event</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event Details Modal -->
            <div v-if="selectedEvent" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-lg p-6 bg-white rounded-lg">
                    <h2 class="text-2xl font-bold">{{ selectedEvent.name }}</h2>
                    <p class="mt-1 text-sm text-gray-500">{{ selectedEvent.date }} • {{ selectedEvent.location }}</p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ selectedEvent.description }}</p>
                    <button @click="selectedEvent = null" class="w-full mt-4 btn-primary">Close</button>
                </div>
            </div>

            <!-- Create Event Button -->
            <div class="flex justify-center mt-4">
                <button @click="createEvent" class="px-4 py-2 text-white transition-colors bg-orange-600 rounded-lg hover:bg-orange-700">
                    Create Event
                </button>
            </div>

            <!-- Events Map -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Events Map</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="/images/events-map.jpg" alt="Events Map" class="object-cover w-full h-full rounded-lg">
                    </div>
                    <button class="w-full mt-4 btn-primary">
                        <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        View Interactive Events Map
                    </button>
                </div>
            </div>

            <!-- Sort Events -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Sort Events</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Latest Events
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Events in Nearest Major City
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Music
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Sports
                        </button>
                    </div>
                </div>
            </div>

            <!-- Back Links -->
            <div class="flex flex-wrap items-center gap-2 justify-evenly">
                <Link
                    :href="`/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}`"
                    class="px-4 py-2 text-orange-500 transition-colors duration-200 border rounded-lg hover:bg-orange-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ town?.name }}
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.btn-primary {
    @apply px-4 py-2 text-white bg-orange-600 rounded-lg hover:bg-orange-700 transition-colors;
}
</style>
