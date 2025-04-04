<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { type Continent, type Country, type State, type Resort } from '@/types';
import { ref, computed } from 'vue';

const props = defineProps<{
    continent?: Continent | null;
    country?: Country | null;
    states: State[];
    resorts?: Resort[]; // Added resorts prop
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    {
        title: props.continent?.name ?? 'Unknown',
        href: props.continent ? `/resorts/${props.continent.slug}` : '#'
    },
    {
        title: props.country?.name ?? 'Unknown',
        href: props.continent && props.country
            ? `/resorts/${props.continent.slug}/${props.country.slug}`
            : '#'
    },
];

// Sorting functionality
const activeTab = ref<'states' | 'resorts'>('states');
const sortBy = ref<'name' | 'count'>('name');
const sortDirection = ref<'asc' | 'desc'>('asc');

const sortedStates = computed(() => {
    return [...props.states].sort((a, b) => {
        if (sortBy.value === 'name') {
            return sortDirection.value === 'asc'
                ? a.name.localeCompare(b.name)
                : b.name.localeCompare(a.name);
        } else {
            return sortDirection.value === 'asc'
                ? (a.resort_count || 0) - (b.resort_count || 0)
                : (b.resort_count || 0) - (a.resort_count || 0);
        }
    });
});

const sortedResorts = computed(() => {
    if (!props.resorts) return [];
    return [...props.resorts].sort((a, b) => {
        return sortDirection.value === 'asc'
            ? a.name.localeCompare(b.name)
            : b.name.localeCompare(a.name);
    });
});

const toggleSortDirection = () => {
    sortDirection.value = sortDirection.value === 'asc' ? 'desc' : 'asc';
};

const setSortBy = (type: 'name' | 'count') => {
    sortBy.value = type;
};
</script>

<template>
    <Head :title="`Resorts - ${country?.name ?? 'Unknown'}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Country Header -->
            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="text-center">
                    <h1 class="p-4 text-3xl font-bold">{{ country?.name ?? 'Unknown' }}</h1>
                    <p v-if="country?.description" class="px-6 pb-4 text-gray-600 dark:text-gray-400">
                        {{ country.description }}
                    </p>
                    <p class="text-lg">
                        <span class="font-medium">Continent:</span> {{ continent?.name ?? 'Unknown' }}
                    </p>
                </div>
            </div>

            <!-- Tabs and Sorting Controls -->
            <div class="flex flex-col gap-4 p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="flex border-b border-gray-200 dark:border-gray-700">
                    <button
                        @click="activeTab = 'states'"
                        :class="{
                            'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500': activeTab === 'states',
                            'hover:text-gray-600 dark:hover:text-gray-300': activeTab !== 'states'
                        }"
                        class="px-4 py-2 font-medium text-center border-b-2 border-transparent cursor-pointer"
                    >
                        States ({{ states.length }})
                    </button>
                    <button
                        v-if="resorts"
                        @click="activeTab = 'resorts'"
                        :class="{
                            'text-blue-600 border-blue-600 dark:text-blue-500 dark:border-blue-500': activeTab === 'resorts',
                            'hover:text-gray-600 dark:hover:text-gray-300': activeTab !== 'resorts'
                        }"
                        class="px-4 py-2 font-medium text-center border-b-2 border-transparent cursor-pointer"
                    >
                        Resorts ({{ resorts.length }})
                    </button>
                </div>

                <div class="flex items-center gap-4">
                    <div class="text-sm font-medium">Sort by:</div>
                    <div class="flex gap-2">
                        <button
                            @click="setSortBy('name')"
                            :class="{
                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100': sortBy === 'name',
                                'hover:bg-gray-100 dark:hover:bg-gray-700': sortBy !== 'name'
                            }"
                            class="px-3 py-1 text-sm font-medium rounded-lg"
                        >
                            Name
                        </button>
                        <button
                            v-if="activeTab === 'states'"
                            @click="setSortBy('count')"
                            :class="{
                                'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100': sortBy === 'count',
                                'hover:bg-gray-100 dark:hover:bg-gray-700': sortBy !== 'count'
                            }"
                            class="px-3 py-1 text-sm font-medium rounded-lg"
                        >
                            Resort Count
                        </button>
                    </div>
                    <button
                        @click="toggleSortDirection"
                        class="p-1 text-gray-500 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700"
                        :title="sortDirection === 'asc' ? 'Ascending' : 'Descending'"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="w-5 h-5"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            :class="{
                                'transform rotate-180': sortDirection === 'desc'
                            }"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- States Grid -->
            <div v-if="activeTab === 'states' && sortedStates.length" class="grid gap-4 auto-rows-min md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div
                    v-for="state in sortedStates"
                    :key="state.id"
                    class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
                >
                    <template v-if="continent && country">
                        <!-- Visible content -->
                        <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 group-hover:opacity-0">
                            <div class="text-center">
                                <h2 class="text-2xl font-medium">{{ state.name }}</h2>
                                <p v-if="state.resort_count" class="mt-2 text-gray-600 dark:text-gray-400">
                                    {{ state.resort_count }} resorts
                                </p>
                                <p v-if="state.code" class="mt-1 font-mono text-sm">
                                    {{ state.code }}
                                </p>
                            </div>
                        </div>

                        <!-- Hover content -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                            <Link
                                :href="`/resorts/${continent.slug}/${country.slug}/${state.slug}`"
                                class="px-6 py-3 text-xl font-medium transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700"
                            >
                                Explore {{ state.name }}
                            </Link>
                            <p v-if="state.description" class="mt-4 text-center text-gray-300">
                                {{ state.description }}
                            </p>
                        </div>
                    </template>
                    <template v-else>
                        <!-- Disabled state when missing required params -->
                        <div class="text-center">
                            <h2 class="text-2xl font-medium">{{ state.name }}</h2>
                            <p class="mt-2 text-gray-500">
                                State unavailable
                            </p>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Resorts Grid -->
            <div v-else-if="activeTab === 'resorts' && sortedResorts.length" class="grid gap-4 auto-rows-min md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div
                    v-for="resort in sortedResorts"
                    :key="resort.id"
                    class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
                >
                    <template v-if="continent && country">
                        <!-- Visible content -->
                        <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 group-hover:opacity-0">
                            <div class="text-center">
                                <h2 class="text-2xl font-medium">{{ resort.name }}</h2>
                                <p v-if="resort.state" class="mt-2 text-gray-600 dark:text-gray-400">
                                    {{ resort.state }}
                                </p>
                            </div>
                        </div>

                        <!-- Hover content -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                            <Link
                                :href="`/resorts/${continent.slug}/${country.slug}/${resort.state_slug}/${resort.slug}`"
                                class="px-6 py-3 text-xl font-medium transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700"
                            >
                                View {{ resort.name }}
                            </Link>
                            <p v-if="resort.base_elevation" class="mt-2 text-gray-300">
                                Elevation: {{ resort.base_elevation }}m
                            </p>
                        </div>
                    </template>
                    <template v-else>
                        <!-- Disabled state when missing required params -->
                        <div class="text-center">
                            <h2 class="text-2xl font-medium">{{ resort.name }}</h2>
                            <p class="mt-2 text-gray-500">
                                Resort unavailable
                            </p>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Empty State -->
            <div v-else class="relative flex items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-8 text-center">
                    <h2 class="text-2xl font-medium">
                        {{ activeTab === 'states' ? 'No states found' : 'No resorts found' }}
                    </h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        {{ activeTab === 'states'
                            ? 'There are no states available for this country'
                            : 'There are no resorts available for this country' }}
                    </p>
                </div>
            </div>

            <!-- Back Link -->
            <div class="flex justify-center">
                <Link
                    v-if="continent"
                    :href="`/resorts/${continent.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ continent?.name || 'Continent' }}
                </Link>
                <Link
                    v-else
                    href="/resorts/continents"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to Continents
                </Link>
            </div>
        </div>
    </AppLayout>
</template>
