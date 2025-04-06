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

// Sample data - replace with your actual API data
const culturalVenues = {
    galleries: [
        {
            id: 1,
            name: 'Mountain Contemporary',
            type: 'Art Gallery',
            description: 'Showcasing regional artists with monthly exhibitions',
            hours: 'Wed-Sun 11am-6pm',
            featuredImage: '/images/gallery1.jpg'
        },
        {
            id: 2,
            name: 'Alpine Folk Art',
            type: 'Gallery & Studio',
            description: 'Traditional crafts and working artist demonstrations',
            hours: 'Daily 10am-5pm',
            featuredImage: '/images/gallery2.jpg'
        }
    ],
    museums: [
        {
            id: 1,
            name: 'Ski Heritage Museum',
            type: 'History Museum',
            description: 'Chronicling 100 years of mountain culture',
            hours: 'Tue-Sat 10am-4pm',
            featuredImage: '/images/museum1.jpg'
        }
    ],
    studios: [
        {
            id: 1,
            name: 'River Arts Collective',
            type: 'Artist Studios',
            description: 'Working studios open to the public every first Friday',
            hours: 'By appointment',
            featuredImage: '/images/studio1.jpg'
        }
    ],
    performances: [
        {
            id: 1,
            name: 'Mountain Playhouse',
            type: 'Theater',
            description: 'Local productions in an intimate historic venue',
            hours: 'Seasonal schedule',
            featuredImage: '/images/theater1.jpg'
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
    { title: 'Arts & Culture', href: '#' }
];
</script>

<template>
    <Head :title="`Arts & Culture - ${town?.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center">
                    <h1 class="text-3xl font-bold">Arts & Culture in {{ town?.name }}</h1>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Discover the creative spirit of our mountain community</p>
                </div>
            </div>

            <!-- Current Exhibits/Events -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Featured This Month</h2>
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="relative overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img src="/images/featured-exhibit.jpg" alt="Featured Exhibit" class="object-cover w-full h-48">
                            <div class="p-4">
                                <div class="flex items-center justify-between">
                                    <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded dark:bg-blue-900 dark:text-blue-100">Exhibition</span>
                                    <span class="text-sm text-gray-500">Through Jan 15</span>
                                </div>
                                <h3 class="mt-2 text-xl font-semibold">Winter Light: Alpine Abstracts</h3>
                                <p class="mt-1 text-gray-600 dark:text-gray-300">Mountain Contemporary Gallery</p>
                                <button class="w-full mt-4 btn-primary">View Details</button>
                            </div>
                        </div>
                        <div class="relative overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img src="/images/featured-event.jpg" alt="Featured Event" class="object-cover w-full h-48">
                            <div class="p-4">
                                <div class="flex items-center justify-between">
                                    <span class="px-2 py-1 text-xs font-semibold text-purple-800 bg-purple-100 rounded dark:bg-purple-900 dark:text-purple-100">Performance</span>
                                    <span class="text-sm text-gray-500">Dec 20-22</span>
                                </div>
                                <h3 class="mt-2 text-xl font-semibold">A Christmas Carol</h3>
                                <p class="mt-1 text-gray-600 dark:text-gray-300">Mountain Playhouse Theater</p>
                                <button class="w-full mt-4 btn-primary">Get Tickets</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Art Galleries Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Art Galleries</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="gallery in culturalVenues.galleries" :key="'gallery-'+gallery.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="gallery.featuredImage" :alt="gallery.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ gallery.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ gallery.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ gallery.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ gallery.hours }}
                                </div>
                                <button class="w-full mt-4 btn-outline">Visit Gallery</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Museums Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Museums</h2>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div v-for="museum in culturalVenues.museums" :key="'museum-'+museum.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="museum.featuredImage" :alt="museum.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ museum.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ museum.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ museum.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ museum.hours }}
                                </div>
                                <button class="w-full mt-4 btn-outline">View Exhibits</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Artist Studios Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Artist Studios</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="studio in culturalVenues.studios" :key="'studio-'+studio.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="studio.featuredImage" :alt="studio.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ studio.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ studio.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ studio.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ studio.hours }}
                                </div>
                                <button class="w-full mt-4 btn-outline">Schedule Visit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Performances & Theater Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Performances & Theater</h2>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div v-for="venue in culturalVenues.performances" :key="'performance-'+venue.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="venue.featuredImage" :alt="venue.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ venue.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ venue.type }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ venue.description }}</p>
                                <div class="flex items-center mt-3 text-sm">
                                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ venue.hours }}
                                </div>
                                <button class="w-full mt-4 btn-primary">View Season</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cultural Map Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Cultural Map</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="/images/cultural-map.jpg" alt="Cultural Map of {{ town?.name }}" class="object-cover w-full h-full rounded-lg">
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
