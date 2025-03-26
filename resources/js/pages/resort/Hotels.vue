<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ListIcon, GridIcon } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
    currentView: string;
    continent: any;
    country: any;
    resort: any;
    hotels: any;
}>();

const viewMode = ref<'grid' | 'list'>('grid');
const toggleViewMode = () => {
    viewMode.value = viewMode.value === 'grid' ? 'list' : 'grid';
};

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
    { title: 'Hotels' },
];
</script>

<template>
    <Head :title="`Hotels in ${resort.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="currentView === 'hotels'" class="space-y-6">
            <!-- Header section -->
            <div class="relative">
                <!-- Centered title -->
                <div class="py-12 text-center">
                    <h1 class="mb-4 text-4xl font-bold">Hotels in {{ resort.name }}</h1>
                    <p class="text-lg text-gray-600">
                        Compare prices from top booking sites
                    </p>
                </div>

                <!-- View toggle button (absolutely positioned) -->
                <button
                    @click="toggleViewMode"
                    class="absolute right-0 flex items-center gap-2 px-4 py-2 text-sm font-medium transition-colors border rounded-lg top-12 hover:bg-gray-700"
                    :title="`Switch to ${viewMode === 'grid' ? 'list' : 'grid'} view`"
                >
                    <span v-if="viewMode === 'grid'">
                        <ListIcon class="w-5 h-5" />
                        <span class="sr-only">List view</span>
                    </span>
                    <span v-else>
                        <GridIcon class="w-5 h-5" />
                        <span class="sr-only">Grid view</span>
                    </span>
                </button>
            </div>

            <!-- Error Message -->
            <div v-if="hotels?.error" class="p-4 text-red-700 bg-red-100 rounded-lg">
                {{ hotels.error }}
            </div>

            <!-- Loading State -->
            <div v-else-if="!hotels || hotels.length === 0" class="py-8 text-center">
                <p>Loading hotel data...</p>
            </div>

            <!-- Hotel List -->
            <div
                :class="{
                    'grid gap-6 md:grid-cols-2 lg:grid-cols-3': viewMode === 'grid',
                    'space-y-4 max-w-5xl mx-auto': viewMode === 'list'
                }"
            >
                <div
                    v-for="hotel in hotels"
                    :key="hotel.hotelId || hotel.name"
                    class="overflow-hidden transition-shadow border rounded-lg shadow-sm hover:shadow-md"
                    :class="{
                        'flex flex-col': viewMode === 'grid',
                        'flex flex-row items-start gap-4': viewMode === 'list'
                    }"
                >
                    <div
                        v-if="viewMode === 'list'"
                        class="w-1/3 h-48 overflow-hidden rounded-l-lg"
                    >
                        <img
                            v-if="hotel.image"
                            :src="hotel.image"
                            :alt="hotel.name"
                            class="object-cover w-full h-full"
                        >
                        <div v-else class="flex items-center justify-center w-full h-full bg-gray-00">
                            <span class="text-gray-500">No image</span>
                        </div>
                    </div>

                    <div class="flex-1 p-4">
                        <div class="flex items-start justify-between">
                            <h3 class="text-lg font-semibold">{{ hotel.name }}</h3>
                            <span class="px-2 py-1 text-sm text-blue-100 bg-blue-900 rounded">
                                {{ hotel.price1 || 'Price not available' }}
                            </span>
                        </div>

                        <div class="flex items-center mt-2">
                            <span class="text-yellow-400">★</span>
                            <span class="ml-1">
                                {{ hotel.reviews?.rating || 'N/A' }}
                                ({{ hotel.reviews?.count || 0 }} reviews)
                            </span>
                        </div>

                        <p class="mt-2 text-sm text-gray-600">
                            {{ hotel.telephone || 'Phone not available' }}
                        </p>

                        <div class="mt-4">
                            <a
                                v-if="hotel.vendor1"
                                :href="`https://${hotel.vendor1.toLowerCase().replace('.com', '')}.com`"
                                target="_blank"
                                class="px-3 py-1 text-xs bg-gray-900 rounded-full hover:bg-gray-600"
                            >
                                Book at {{ hotel.vendor1 }}
                            </a>
                        </div>

                        <div v-if="viewMode === 'list'" class="mt-4 space-y-2">
                            <p v-if="hotel.geocode" class="text-sm text-gray-500">
                                Location: {{ hotel.geocode.latitude }}, {{ hotel.geocode.longitude }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
