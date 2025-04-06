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

const jobs = ref([
    { id: 1, title: 'Finance Manager', sector: 'Finance', location: 'Whistler', company: 'Ski Resort Inc.', description: 'Manage finances for the resort.', image: '/images/job1.jpg' },
    { id: 2, title: 'Hospitality Coordinator', sector: 'Hospitality', location: 'Whistler', company: 'Mountain Lodge', description: 'Coordinate hospitality services.', image: '/images/job2.jpg' },
    { id: 3, title: 'Tour Guide', sector: 'Tourism', location: 'Whistler', company: 'Adventure Tours', description: 'Lead tours around Whistler.', image: '/images/job3.jpg' },
    { id: 4, title: 'Maintenance Technician', sector: 'Tradie', location: 'Whistler', company: 'Resort Maintenance', description: 'Maintain resort facilities.', image: '/images/job4.jpg' }
]);

const selectedJob = ref(null);

const viewJob = (job) => {
    selectedJob.value = job;
};

const createJob = () => {
    // Navigate to job creation page or open a modal
    console.log('Create Job');
};
</script>

<template>
    <Head title="Jobs Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-green-800 to-green-600">
                    <h1 class="text-3xl font-bold">Jobs in {{ town?.name }}</h1>
                    <p class="mt-2">Explore job opportunities across various sectors</p>
                </div>
            </div>

            <!-- Job Listings -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Job Listings</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="job in jobs" :key="job.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="job.image" :alt="job.title" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ job.title }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ job.sector }} • {{ job.company }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ job.description }}</p>
                                <button @click="viewJob(job)" class="w-full mt-4 btn-primary">View Job</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Job Details Modal -->
            <div v-if="selectedJob" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-lg p-6 bg-white rounded-lg">
                    <h2 class="text-2xl font-bold">{{ selectedJob.title }}</h2>
                    <p class="mt-1 text-sm text-gray-500">{{ selectedJob.sector }} • {{ selectedJob.company }}</p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ selectedJob.description }}</p>
                    <button @click="selectedJob = null" class="w-full mt-4 btn-primary">Close</button>
                </div>
            </div>

            <!-- Create Job Button -->
            <div class="flex justify-center mt-4">
                <button @click="createJob" class="px-4 py-2 text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                    Create Job Listing
                </button>
            </div>

            <!-- Job Map -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Job Map</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="/images/job-map.jpg" alt="Job Map" class="object-cover w-full h-full rounded-lg">
                    </div>
                    <button class="w-full mt-4 btn-primary">
                        <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        View Interactive Job Map
                    </button>
                </div>
            </div>

            <!-- Sort Jobs -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Sort Jobs</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Finance
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Hospitality
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Tourism
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Tradie
                        </button>
                    </div>
                </div>
            </div>

            <!-- Apply for Jobs -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Apply for Jobs</h2>
                    <form class="grid gap-4">
                        <div>
                            <label for="resume" class="block text-sm font-medium text-gray-700">Resume</label>
                            <input type="file" id="resume" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <div>
                            <label for="cover-letter" class="block text-sm font-medium text-gray-700">Cover Letter</label>
                            <input type="file" id="cover-letter" class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                        </div>
                        <button type="submit" class="w-full px-4 py-2 text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                            Apply
                        </button>
                    </form>
                </div>
            </div>

            <!-- Back Links -->
            <div class="flex flex-wrap items-center gap-2 justify-evenly">
                <Link
                    :href="`/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}`"
                    class="px-4 py-2 text-green-500 transition-colors duration-200 border rounded-lg hover:bg-green-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ town?.name }}
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.btn-primary {
    @apply px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition-colors;
}
</style>
