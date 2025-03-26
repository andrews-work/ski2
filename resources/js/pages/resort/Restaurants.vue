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
    restaurants: any[];
    debug?: boolean;
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
    { title: 'Restaurants' },
];
</script>

<template>
    <Head title="Restaurants" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="currentView === 'restaurants'" class="p-4">
            <!-- Header section -->
            <div class="relative">
                <!-- Centered title -->
                <div class="py-12 text-center">
                    <h1 class="mb-4 text-4xl font-bold">Restaurants in {{ resort.name }}</h1>
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

            <div :class="{'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4': viewMode === 'grid', 'space-y-4': viewMode === 'list'}">
                <div
                    v-for="restaurant in restaurants"
                    :key="restaurant.id"
                    class="p-3 border rounded"
                    :class="{'flex items-center': viewMode === 'list'}"
                >
                    {{ restaurant.name }}
                </div>

                <div v-if="restaurants.length === 0" class="text-gray-500">
                    No restaurants found
                </div>
            </div>
        </div>
    </AppLayout>
</template>
