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

const activeTab = ref('combined');

const categories = [
    { id: 'hot-tubs', label: 'Hot Tubs' },
    { id: 'medicinals', label: 'Medicinals' },
    { id: 'museums', label: 'Museums' },
    { id: 'arts', label: 'Arts' },
    { id: 'activities', label: 'Activities' },
    { id: 'backcountry', label: 'Backcountry' },
    { id: 'companies', label: 'Companies' },
    { id: 'events', label: 'Events' },
    { id: 'fitness', label: 'Fitness' },
    { id: 'jobs', label: 'Jobs' },
    { id: 'marketplace', label: 'Marketplace' },
    { id: 'rentals', label: 'Rentals' },
    { id: 'resorts', label: 'Resorts' },
    { id: 'transport', label: 'Transport' },
];

const sampleData = ref([
    { id: 1, category: 'hot-tubs', name: 'Luxury Spa', location: 'Downtown' },
    { id: 2, category: 'medicinals', name: 'Herbal Remedies', location: 'Health District' },
    { id: 3, category: 'museums', name: 'Art Gallery', location: 'Cultural Center' },
    // Add more sample data as needed
]);

const filteredData = () => {
    if (activeTab.value === 'combined') {
        return sampleData.value;
    }
    return sampleData.value.filter(item => item.category === activeTab.value);
};
</script>

<template>
    <Head title="Info Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-blue-800 to-blue-600">
                    <h1 class="text-3xl font-bold">Info Page for {{ town?.name }}</h1>
                    <p class="mt-2">Discover various points of interest and activities</p>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="flex overflow-x-auto border-b border-sidebar-border/70 dark:border-sidebar-border">
                <button
                    v-for="category in categories"
                    :key="category.id"
                    @click="activeTab = category.id"
                    :class="['px-4 py-3 text-sm font-medium whitespace-nowrap', activeTab === category.id ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700']"
                >
                    {{ category.label }}
                </button>
                <button
                    @click="activeTab = 'combined'"
                    :class="['px-4 py-3 text-sm font-medium whitespace-nowrap', activeTab === 'combined' ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700']"
                >
                    Combined
                </button>
            </div>

            <!-- Content Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <h2 class="mb-6 text-2xl font-bold">{{ activeTab === 'combined' ? 'All Categories' : categories.find(cat => cat.id === activeTab)?.label }}</h2>
                    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                        <div v-for="item in filteredData()" :key="item.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                            <div class="p-4">
                                <h3 class="text-xl font-semibold">{{ item.name }}</h3>
                                <p class="mt-1 text-sm text-gray-500">Location: {{ item.location }}</p>
                                <p class="mt-2 text-gray-600 dark:text-gray-300">Details about {{ item.name }}</p>
                                <button class="w-full mt-4 btn-primary">View on Map</button>
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
</style>
