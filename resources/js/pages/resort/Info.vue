<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import Weather from '@/components/resorts/info/weather.vue';
import Geography from '@/components/resorts/info/geography.vue';
import HeroImage from '@/components/resorts/resort/heroImage.vue';

const props = defineProps<{
    currentView: string;
    continent: any;
    country: any;
    resort: any;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
    { title: 'Info' },
];
</script>

<template>
    <Head title="Info Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="currentView === 'info'">

            <HeroImage :resort="resort" />

            <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">

                <div class="grid gap-4 auto-rows-min md:grid-cols-8">
                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="text-2xl">{{ resort.state_code }}</h1>
                    </div>
                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="text-xl">{{ country.name }}</h1>
                    </div>
                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="text-xl">{{ resort.local_time }}</h1>
                    </div>
                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">{{ resort.base_elevation ? resort.base_elevation + ' m' : 'N/A' }}</h1>
                        <h1 class="text-gray-500">Elevation</h1>
                    </div>
                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">{{ resort.latitude }}</h1>
                        <h1 class="text-gray-500">Latitude</h1>
                    </div>
                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">{{ resort.longitude }}</h1>
                        <h1 class="text-gray-500">Longitude</h1>
                    </div>
                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">{{ resort.lift_open }}</h1>
                        <h1 class="text-gray-500">Lift Open</h1>
                    </div>
                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">{{ resort.lift_close }}</h1>
                        <h1 class="text-gray-500">Lift Close</h1>
                    </div>
                </div>

                <div class="grid gap-4 auto-rows-min md:grid-cols-4">

                    <div class="relative flex items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="text-4xl text-center">{{ resort.name }}</h1>
                    </div>

                    <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>36 blacks</h1>
                        <h1>30 blue's</h1>
                        <h1>30 greens</h1>
                        <h1>2 parks</h1>
                    </div>

                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                            <h2 class="p-2 text-xl font-bold">Lift Status</h2>
                            <div class="h-64 p-2 overflow-y-auto">
                                <div v-if="resort.lift_data">
                                    <!-- Summary Stats -->
                                    <div class="p-2 mb-4 bg-gray-100 rounded-lg dark:bg-gray-800">
                                        <div class="flex justify-between">
                                            <span>Open:</span>
                                            <span class="text-green-500">{{ resort.lift_data.lift_stats.open }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Scheduled:</span>
                                            <span class="text-yellow-500">{{ resort.lift_data.lift_stats.scheduled }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Closed:</span>
                                            <span class="text-red-500">{{ resort.lift_data.lift_stats.closed }}</span>
                                        </div>
                                        <div class="flex justify-between mt-1 font-bold">
                                            <span>Total Lifts:</span>
                                            <span>{{ Object.keys(resort.lift_data.lift_status).length }}</span>
                                        </div>
                                    </div>

                                    <!-- Individual Lifts -->
                                    <div v-for="(status, lift) in resort.lift_data.lift_status" :key="lift"
                                        class="flex justify-between py-1 border-b cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800"
                                        @click="$inertia.visit(`/resorts/${continent.slug}/${country.slug}/${resort.slug}/weather`)">
                                        <span>{{ lift }}</span>
                                        <span :class="{
                                            'text-green-500': status === 'open',
                                            'text-red-500': status === 'closed',
                                            'text-yellow-500': status === 'scheduled'
                                        }">
                                            {{ status }}
                                        </span>
                                    </div>
                                </div>
                                <div v-else>
                                    <p>Lift data not available</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <!-- Empty cell -->
                    </div>

                </div>

            </div>
        </div>
    </AppLayout>
</template>
