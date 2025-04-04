<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type Continent, type Country, type State, type Town, type Resort } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps<{
    continent: Continent | null;
    countries: Country[];
    country: Country | null;
    states: State[];
    towns: Town[];
    resorts: Resort[];
}>();

const activeTab = ref('countries');

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent?.name ?? 'Unknown', href: props.continent ? `/resorts/${props.continent.slug}` : '#' },
];
</script>

<template>
    <Head :title="`Resorts - ${continent?.name ?? 'Unknown'} Countries`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">

            <!-- Continent Header -->
            <div class="relative flex flex-col items-center justify-center h-40 overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <h1 class="p-4 text-3xl font-bold">{{ continent?.name ?? 'Unknown' }}</h1>
            </div>

            <!-- Tabs -->
            <div class="flex border-b justify-evenly border-sidebar-border/70 dark:border-sidebar-border">
                <button
                    @click="activeTab = 'countries'"
                    :class="{
                        'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'countries',
                        'text-gray-600 dark:text-gray-400': activeTab !== 'countries'
                    }"
                    class="px-4 py-2 font-medium focus:outline-none"
                >
                    Countries
                </button>

                <button
                    @click="activeTab = 'states'"
                    :class="{
                        'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'states',
                        'text-gray-600 dark:text-gray-400': activeTab !== 'states'
                    }"
                    class="px-4 py-2 font-medium focus:outline-none"
                >
                    States
                </button>

                <button
                    @click="activeTab = 'towns'"
                    :class="{
                        'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'towns',
                        'text-gray-600 dark:text-gray-400': activeTab !== 'towns'
                    }"
                    class="px-4 py-2 font-medium focus:outline-none"
                >
                    Towns
                </button>

                <button
                    @click="activeTab = 'resorts'"
                    :class="{
                        'border-b-2 border-blue-500 text-blue-600 dark:text-blue-400': activeTab === 'resorts',
                        'text-gray-600 dark:text-gray-400': activeTab !== 'resorts'
                    }"
                    class="px-4 py-2 font-medium focus:outline-none"
                >
                    Resorts
                </button>
            </div>

            <!-- Countries Grid -->
            <div v-if="activeTab === 'countries' && countries.length" class="grid gap-4 auto-rows-min md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div
                    v-for="country in countries"
                    :key="country.id"
                    class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
                >
                    <!-- Visible content -->
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 group-hover:opacity-0">
                        <div class="text-center">
                            <h2 class="text-2xl font-medium">{{ country.name }}</h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
    {{ country.resorts_count }} {{ country.resorts_count === 1 ? 'resort' : 'resorts' }}
</p>
                        </div>
                    </div>

                    <!-- Hover content -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                        <Link
                            :href="`/resorts/${continent?.slug}/${country.slug}`"
                            class="px-6 py-3 text-xl font-medium transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700"
                        >
                            Explore {{ country.name }}
                        </Link>
                    </div>
                </div>
            </div>

            <!-- States Grid -->
            <div v-if="activeTab === 'states' && states.length" class="grid gap-4 auto-rows-min md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div
                    v-for="state in states"
                    :key="state.id"
                    class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
                >
                    <!-- Visible content -->
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 group-hover:opacity-0">
                        <div class="text-center">
                            <h2 class="text-2xl font-medium">{{ state.name }}</h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
    {{ state.resorts_count }} {{ state.resorts_count === 1 ? 'town' : 'towns' }}
</p>
                        </div>
                    </div>

                    <!-- Hover content -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                        <Link
                            :href="`/resorts/${continent?.slug}/${country?.slug || 'unknown'}/${state.slug}`"
                            class="px-6 py-3 text-xl font-medium transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700"
                        >
                            Explore {{ state.name }}
                        </Link>
                    </div>
                </div>
            </div>

            <!-- Towns Grid -->
            <div v-if="activeTab === 'towns' && towns.length" class="grid gap-4 auto-rows-min md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div
                    v-for="town in towns"
                    :key="town.id"
                    class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
                >
                    <!-- Visible content -->
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 group-hover:opacity-0">
                        <div class="text-center">
                            <h2 class="text-2xl font-medium">{{ town.name }}</h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
    {{ town.resorts_count }} {{ town.resorts_count === 1 ? 'resort' : 'resorts' }}
</p>
                        </div>
                    </div>

                    <!-- Hover content -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                        <Link
                        :href="`/resorts/${continent?.slug}/${country?.slug}/${town.state.slug}/${town.slug}`"
                        class="px-6 py-3 text-xl font-medium transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700"
                    >
                        Explore {{ town.name }}
                    </Link>
                    </div>
                </div>
            </div>

            <!-- Resorts Grid -->
            <div v-if="activeTab === 'resorts' && resorts.length" class="grid gap-4 auto-rows-min md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <div
                    v-for="resort in resorts"
                    :key="resort.id"
                    class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
                >
                    <!-- Visible content -->
                    <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 group-hover:opacity-0">
                        <div class="text-center">
                            <h2 class="text-2xl font-medium">{{ resort.name }}</h2>
                            <p class="mt-2 text-gray-600 dark:text-gray-400">
                                {{ resort.town?.name }}, {{ resort.town?.state?.name }}
                            </p>
                        </div>
                    </div>

                    <!-- Hover content -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                        <Link
                        :href="`/resorts/${continent?.slug}/${country?.slug}/${resort.town.state.slug}/${resort.town.slug}/${resort.slug}`"
                        class="px-6 py-3 text-xl font-medium transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700"
                    >
                        View {{ resort.name }}
                    </Link>
                    </div>
                </div>
            </div>

            <!-- Empty State -->
            <div v-if="
                (activeTab === 'countries' && !countries.length) ||
                (activeTab === 'states' && !states.length) ||
                (activeTab === 'towns' && !towns.length) ||
                (activeTab === 'resorts' && !resorts.length)
            " class="relative flex items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-8 text-center">
                    <h2 class="text-2xl font-medium">No {{ activeTab }} found</h2>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">
                        There are no {{ activeTab }} available for this continent
                    </p>
                </div>
            </div>

            <!-- Back Link -->
            <div class="flex justify-center">
                <Link
                    :href="`/resorts/continents`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to Continents
                </Link>
            </div>

        </div>
    </AppLayout>
</template>
