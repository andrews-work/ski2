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

const companies = ref([
    { id: 1, name: 'Ski Resort Inc.', sector: 'Tourism', location: 'Whistler', services: 'Skiing, Snowboarding', image: '/images/company1.jpg' },
    { id: 2, name: 'Mountain Lodge', sector: 'Hospitality', location: 'Whistler', services: 'Accommodation, Dining', image: '/images/company2.jpg' },
    { id: 3, name: 'Adventure Tours', sector: 'Tourism', location: 'Whistler', services: 'Guided Tours, Adventure Activities', image: '/images/company3.jpg' },
    { id: 4, name: 'Resort Maintenance', sector: 'Tradie', location: 'Whistler', services: 'Maintenance, Repairs', image: '/images/company4.jpg' }
]);

const selectedCompany = ref(null);

const viewCompany = (company) => {
    selectedCompany.value = company;
};

const createCompany = () => {
    // Navigate to company creation page or open a modal
    console.log('Create Company');
};
</script>

<template>
    <Head title="Companies Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-purple-800 to-purple-600">
                    <h1 class="text-3xl font-bold">Companies in {{ town?.name }}</h1>
                    <p class="mt-2">Explore businesses and services across various sectors</p>
                </div>
            </div>

            <!-- Company Listings -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Company Listings</h2>
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="company in companies" :key="company.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="company.image" :alt="company.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ company.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">{{ company.sector }} • {{ company.location }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">{{ company.services }}</p>
                                <button @click="viewCompany(company)" class="w-full mt-4 btn-primary">View Company</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Details Modal -->
            <div v-if="selectedCompany" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-lg p-6 bg-white rounded-lg">
                    <h2 class="text-2xl font-bold">{{ selectedCompany.name }}</h2>
                    <p class="mt-1 text-sm text-gray-500">{{ selectedCompany.sector }} • {{ selectedCompany.location }}</p>
                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ selectedCompany.services }}</p>
                    <button @click="selectedCompany = null" class="w-full mt-4 btn-primary">Close</button>
                </div>
            </div>

            <!-- Create Company Button -->
            <div class="flex justify-center mt-4">
                <button @click="createCompany" class="px-4 py-2 text-white transition-colors bg-purple-600 rounded-lg hover:bg-purple-700">
                    Create Company Account
                </button>
            </div>

            <!-- Company Map -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Company Map</h2>
                    <div class="aspect-w-16 aspect-h-9">
                        <img src="/images/company-map.jpg" alt="Company Map" class="object-cover w-full h-full rounded-lg">
                    </div>
                    <button class="w-full mt-4 btn-primary">
                        <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        View Interactive Company Map
                    </button>
                </div>
            </div>

            <!-- Sort Companies -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">Sort Companies</h2>
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Tourism
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Hospitality
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Tradie
                        </button>
                        <button class="p-4 text-center transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                            Finance
                        </button>
                    </div>
                </div>
            </div>

            <!-- Back Links -->
            <div class="flex flex-wrap items-center gap-2 justify-evenly">
                <Link
                    :href="`/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}`"
                    class="px-4 py-2 text-purple-500 transition-colors duration-200 border rounded-lg hover:bg-purple-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ town?.name }}
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.btn-primary {
    @apply px-4 py-2 text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition-colors;
}
</style>
