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

const activeTab = ref('fitness');

// Sample data for fitness facilities
const fitnessFacilities = ref([
    { id: 1, name: 'Whistler Gym', type: 'Gym', category: 'fitness', location: 'Whistler', description: 'State-of-the-art gym with various equipment.', image: '/images/gym1.jpg' },
    { id: 2, name: 'Mountain Yoga Studio', type: 'Yoga', category: 'fitness', location: 'Whistler', description: 'Yoga classes for all levels in a serene environment.', image: '/images/yoga1.jpg' },
    { id: 3, name: 'Whistler Pool Complex', type: 'Pool', category: 'fitness', location: 'Whistler', description: 'Indoor and outdoor pools for swimming and relaxation.', image: '/images/pool1.jpg' },
    { id: 4, name: 'Peak Fitness Center', type: 'Gym', category: 'fitness', location: 'Whistler', description: 'Premium fitness center with personal training.', image: '/images/gym2.jpg' }
]);

// Sample data for recovery facilities
const recoveryFacilities = ref([
    { id: 5, name: 'Mountain Physio', type: 'Physiotherapy', category: 'recovery', location: 'Whistler', description: 'Physiotherapy services for athletes and locals.', image: '/images/physio1.jpg' },
    { id: 6, name: 'Alpine Sports Medicine', type: 'Sports Medicine', category: 'recovery', location: 'Whistler', description: 'Doctors and surgeons specializing in sports injuries.', image: '/images/medical1.jpg' },
    { id: 7, name: 'Whistler Massage Therapy', type: 'Massage', category: 'recovery', location: 'Whistler', description: 'Professional massage therapy for recovery and relaxation.', image: '/images/massage1.jpg' },
    { id: 8, name: 'Acupuncture Wellness', type: 'Acupuncture', category: 'recovery', location: 'Whistler', description: 'Traditional Chinese medicine and acupuncture treatments.', image: '/images/acupuncture1.jpg' }
]);

const selectedFacility = ref(null);

const viewFacility = (facility) => {
    selectedFacility.value = facility;
};

const createFacility = () => {
    // Navigate to facility creation page or open a modal
    console.log('Create Facility');
};

const filteredFacilities = () => {
    return activeTab.value === 'fitness' ? fitnessFacilities.value : recoveryFacilities.value;
};
</script>

<template>
    <Head :title="`${activeTab === 'fitness' ? 'Fitness' : 'Recovery'} in ${town?.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-green-800 to-green-600">
                    <h1 class="text-3xl font-bold">{{ activeTab === 'fitness' ? 'Fitness & Wellness' : 'Recovery & Therapy' }} in {{ town?.name }}</h1>
                    <p class="mt-2">{{ activeTab === 'fitness' ? 'Find gyms, yoga studios, pools and more' : 'Discover physios, doctors, massage and recovery services' }}</p>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="flex border-b border-sidebar-border/70 dark:border-sidebar-border">
                <button
                    @click="activeTab = 'fitness'"
                    :class="['px-6 py-3 font-medium', activeTab === 'fitness' ? 'text-green-600 border-b-2 border-green-600' : 'text-gray-500 hover:text-gray-700']"
                >
                    Health & Fitness
                </button>
                <button
                    @click="activeTab = 'recovery'"
                    :class="['px-6 py-3 font-medium', activeTab === 'recovery' ? 'text-green-600 border-b-2 border-green-600' : 'text-gray-500 hover:text-gray-700']"
                >
                    Recovery & Physio
                </button>
            </div>

            <!-- Facility Listings -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">{{ activeTab === 'fitness' ? 'Fitness Facilities' : 'Recovery Services' }}</h2>

                    <!-- Subcategory Filters -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <template v-if="activeTab === 'fitness'">
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                All Fitness
                            </button>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Gyms
                            </button>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Yoga
                            </button>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Pools
                            </button>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                CrossFit
                            </button>
                        </template>
                        <template v-else>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                All Recovery
                            </button>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Physiotherapy
                            </button>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Sports Medicine
                            </button>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Massage
                            </button>
                            <button class="px-4 py-2 text-sm transition-colors border rounded-lg border-sidebar-border/30 hover:bg-gray-100 dark:hover:bg-gray-700">
                                Acupuncture
                            </button>
                        </template>
                    </div>

                    <!-- Facilities Grid -->
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        <div v-for="facility in filteredFacilities()" :key="facility.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <img :src="facility.image" :alt="facility.name" class="object-cover w-full h-48">
                            <div class="p-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-semibold">{{ facility.name }}</h3>
                                    <span class="px-2 py-1 text-xs text-white bg-green-600 rounded-full">{{ facility.type }}</span>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">{{ facility.location }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300 line-clamp-2">{{ facility.description }}</p>
                                <button @click="viewFacility(facility)" class="w-full mt-4 btn-primary">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Facility Details Modal -->
            <div v-if="selectedFacility" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50">
                <div class="w-full max-w-lg p-6 bg-white rounded-lg dark:bg-gray-800">
                    <div class="relative">
                        <h2 class="text-2xl font-bold">{{ selectedFacility.name }}</h2>
                        <p class="mt-1 text-sm text-gray-500">{{ selectedFacility.type }} • {{ selectedFacility.location }}</p>
                        <img :src="selectedFacility.image" :alt="selectedFacility.name" class="object-cover w-full h-48 mt-4 rounded-lg">
                        <p class="mt-4 text-gray-600 dark:text-gray-300">{{ selectedFacility.description }}</p>

                        <div class="mt-6">
                            <h3 class="font-semibold">Services Offered:</h3>
                            <div class="flex flex-wrap gap-2 mt-2">
                                <span v-if="selectedFacility.category === 'fitness'" class="px-2 py-1 text-xs bg-gray-100 rounded dark:bg-gray-700">Fitness Equipment</span>
                                <span v-if="selectedFacility.type === 'Yoga'" class="px-2 py-1 text-xs bg-gray-100 rounded dark:bg-gray-700">Yoga Classes</span>
                                <span v-if="selectedFacility.type === 'Pool'" class="px-2 py-1 text-xs bg-gray-100 rounded dark:bg-gray-700">Swimming</span>
                                <span v-if="selectedFacility.type === 'Physiotherapy'" class="px-2 py-1 text-xs bg-gray-100 rounded dark:bg-gray-700">Injury Rehabilitation</span>
                                <span v-if="selectedFacility.type === 'Massage'" class="px-2 py-1 text-xs bg-gray-100 rounded dark:bg-gray-700">Therapeutic Massage</span>
                            </div>
                        </div>

                        <button @click="selectedFacility = null" class="w-full mt-6 btn-primary">Close</button>
                    </div>
                </div>
            </div>

            <!-- Create Facility Button -->
            <div class="flex justify-center mt-4">
                <button @click="createFacility" class="px-4 py-2 text-white transition-colors bg-green-600 rounded-lg hover:bg-green-700">
                    {{ activeTab === 'fitness' ? 'Add Fitness Facility' : 'Add Recovery Service' }}
                </button>
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

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
