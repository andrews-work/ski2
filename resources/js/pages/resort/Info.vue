<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import HeroImage from '@/components/resorts/resort/heroImage.vue';
import { Wind } from 'lucide-vue-next';
import { getTime12Hour } from '@/utils/date';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const props = defineProps<{
    currentView: string;
    continent: any;
    country: any;
    resort: any;
}>();

const localTime = ref(props.resort.local_time);
const liftData = ref(props.resort.lift_data);

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
    { title: 'Info', href: ''},
];

const fetchUpdates = async () => {
    try {
        const response = await fetch(`/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}/info/update`);

        if (!response.ok) throw new Error('Network response was not ok');

        const data = await response.json();

        if (data.status === 'success') {
            if (data.local_time?.local_time) {
                localTime.value = data.local_time.local_time;
            }
            if (data.lift_data) {
                liftData.value = data.lift_data;
            }
        }
    } catch (error) {
        console.error('Error fetching updates:', error);
    }
};

let updateInterval: number;

onMounted(() => {
    fetchUpdates();

    updateInterval = window.setInterval(fetchUpdates, 30000); // 30 seconds
    console.log('update');
});

onBeforeUnmount(() => {
    if (updateInterval) {
        clearInterval(updateInterval);
    }
});
</script>
<template>
    <Head title="Info Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="currentView === 'info'">

            <HeroImage :resort="resort" />

            <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">

                <div class="grid gap-4 auto-rows-min md:grid-cols-8">

                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="group-hover:opacity-0">
                            <h1 class="text-xl">{{ resort.state_code }}</h1>
                        </div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                            <h1 class="text-xl">{{ resort.state }}</h1>
                        </div>
                    </div>

                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="text-xl">{{ country.name }}</h1>
                    </div>

                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="text-xl">{{ getTime12Hour(localTime) }}</h1>
                    </div>

                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">{{ resort.base_elevation ? resort.base_elevation + ' m' : 'N/A' }}</h1>
                    </div>

                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">{{ resort.open }}</h1>
                    </div>

                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">April 21</h1>
                    </div>

                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">8:30am</h1>
                    </div>

                    <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="">4:00pm</h1>
                    </div>

                </div>

                <div class="grid gap-4 auto-rows-min md:grid-cols-4">

                    <!-- resort name -->
                    <div class="relative flex items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">

                        <!-- Visible content (resort name) -->
                        <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 group-hover:opacity-0">
                            <h1 class="text-2xl text-center">{{ resort.name }}</h1>
                        </div>

                        <!-- Hidden content (coordinates - shows on hover) -->
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                            <h1 class="text-xl">{{ resort.latitude }}</h1>
                            <h2 class="-mt-2 text-sm text-gray-400">Latitude</h2>
                            <h1 class="mt-4 text-xl">{{ resort.longitude }}</h1>
                            <h2 class="-mt-2 text-sm text-gray-400">Longitude</h2>
                        </div>
                    </div>

                    <!-- Runs Display -->
                    <div class="relative p-2 overflow-hidden border md:p-4 aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h2 class="py-1 text-xl text-center md:py-2 md:text-2xl">Runs</h2>
                        <div class="flex items-center justify-center py-1 space-x-4 md:py-2 md:space-x-8">
                            <div class="flex flex-col items-center space-y-1 md:space-y-2">
                                <h1 class="text-base font-medium md:text-lg dark:text-white">green</h1>
                                <div class="w-2 h-2 bg-green-600 rounded-full md:w-3 md:h-3"></div>
                                <h1 class="text-base font-medium md:text-lg dark:text-white">36</h1>
                            </div>

                            <div class="flex flex-col items-center space-y-1 md:space-y-2">
                                <h1 class="text-base font-medium md:text-lg dark:text-white">blue</h1>
                                <div class="w-2 h-2 bg-blue-700 rounded-full md:w-3 md:h-3"></div>
                                <h1 class="text-base font-medium md:text-lg dark:text-white">36</h1>
                            </div>

                            <div class="flex flex-col items-center space-y-1 md:space-y-2">
                                <h1 class="text-base font-medium md:text-lg dark:text-white">blacks</h1>
                                <div class="w-2 h-2 bg-black rounded-full md:w-3 md:h-3"></div>
                                <h1 class="text-base font-medium md:text-lg dark:text-white">36</h1>
                            </div>

                            <div class="flex flex-col items-center space-y-1 md:space-y-2">
                                <h1 class="text-base font-medium md:text-lg dark:text-white">park</h1>
                                <div class="w-2 h-2 bg-yellow-400 rounded-full md:w-3 md:h-3"></div>
                                <h1 class="text-base font-medium md:text-lg dark:text-white">2</h1>
                            </div>
                        </div>
                    </div>

                    <!-- lifts -->
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                            <h2 class="py-4 text-xl font-bold text-center">Lift Status</h2>
                            <div class="h-64 p-2 overflow-y-auto">
                                <div v-if="resort.lift_data && resort.lift_data.lift_stats">
                                    <!-- Summary Stats -->
                                    <div class="p-2 mb-4 rounded-lg">
                                        <div class="flex justify-between">
                                            <span>Open:</span>
                                            <span class="text-green-500">{{ liftData.lift_stats.open }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Scheduled:</span>
                                            <span class="text-yellow-500">{{ liftData.lift_stats.scheduled }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span>Closed:</span>
                                            <span class="text-red-500">{{ liftData.lift_stats.closed || 'N/A' }}</span>
                                        </div>
                                        <div class="flex justify-between mt-1 font-bold">
                                            <span>Total Lifts:</span>
                                            <span>{{ liftData.lift_status ? Object.keys(liftData.lift_status).length : 0 }}</span>
                                        </div>
                                    </div>

                                    <!-- Individual Lifts -->
                                    <!-- <div v-for="(status, lift) in resort.lift_data.lift_status" :key="lift"
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
                                    </div> -->

                                </div>
                                <div v-else>
                                    <p>Lift data not available</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative flex items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <!-- <h1 class="">3 Mountains</h1> -->
                    </div>

                </div>

                <!-- next 24 hours -->
                <div class="grid gap-4 md:grid-cols-1">
                    <div class="p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <Link :href="`/resorts/${continent.slug}/${country.slug}/${resort.slug}/weather`" >
                            <h2 class="py-4 text-2xl text-center">Weather - Next 24 hours</h2>
                            <div class="flex gap-4 pb-4 overflow-x-auto">
                                <div v-for="(hour, index) in resort.weatherData.data.hourly" :key="index"
                                    class="flex flex-col items-center p-3 rounded-lg min-w-40 ">
                                    <!-- Time -->
                                    <span class="text-sm font-medium">
                                        {{ hour.time }}
                                    </span>

                                    <!-- Weather Icon -->
                                    <img v-if="hour.icon"
                                        :src="`https://openweathermap.org/img/wn/${hour.icon}.png`"
                                        :alt="hour.weather_description"
                                        class="w-10 h-10">

                                    <!-- Temperature -->
                                    <span class="text-lg font-bold">{{ hour.temp }}°C</span>

                                    <!-- Wind Speed -->
                                    <div class="flex items-center gap-1">
                                        <Wind />
                                        <span class="text-sm">{{ hour.wind_speed }} km/h</span>
                                    </div>

                                    <!-- Visibility -->
                                    <div class="flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span class="text-sm">{{ hour.visibility }} km</span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    </div>
                </div>

                <!-- map -->
                <div class="grid gap-4 md:grid-cols-1">
                    <div class="p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>show resort map here</h1>
                    </div>
                </div>

                <!-- links -->
                <div class="grid gap-4 md:grid-cols-1">
                    <div class="p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>show links</h1>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
