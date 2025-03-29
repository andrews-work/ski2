<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ListIcon, GridIcon, Sunrise, Sunset } from 'lucide-vue-next';
import { ref, onMounted  } from 'vue';
import { getTime12Hour } from '@/utils/date';

const props = defineProps<{
    currentView: string;
    continent: any;
    country: any;
    resort: any;
    debug?: boolean;
    weatherData: any;
}>();

onMounted(() => {
    console.log('Weather Data:', props.weatherData);
    if (props.weatherData?.status === 'error') {
        console.error('Weather Error:', props.weatherData.error);
    }
});

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
    { title: 'Weather' },
];

// Tab functionality
const activeTab = ref('today');
const tabs = [
    { id: 'today', label: 'Today' },
    { id: 'tomorrow', label: 'Tomorrow' },
    { id: 'threeDays', label: '3 Days' }
];
</script>

<template>
    <Head title="Weather" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="currentView === 'weather'">
            <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">

                <div class="py-12 text-center">
                    <h1 class="text-4xl font-bold">Weather in {{ resort.name }}</h1>
                </div>

                <!-- current -->
                <div class="grid gap-4 md:grid-cols-1">
                    <div class="flex gap-4 p-4 border justify-evenly md:grid-cols-1 rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <!-- Sunrise/Sunset keep their original styling -->
                        <div class="flex items-center gap-2">
                            <Sunrise class="w-5 h-5" />
                            <span>{{ getTime12Hour(weatherData?.data?.sunrise) }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <Sunset class="w-5 h-5" />
                            <span>{{ getTime12Hour(weatherData?.data?.sunset) }}</span>
                        </div>

                        <!-- Weather metrics with grey labels -->
                        <h1><span class="text-gray-500 dark:text-gray-400">Temp:</span> {{weatherData?.data?.temp }} ˚C</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Feels:</span> {{ weatherData?.data?.feels_like }} ˚C</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Visibility:</span> {{ weatherData?.data?.visibility }}m</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">UV Index:</span> {{ weatherData?.data?.uvi }}</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Wind:</span> {{ weatherData?.data?.wind_speed }} km/h</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">24h Snow:</span> {{ weatherData?.data?.daily_snow }} mm</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Snow 1hr:</span> {{ weatherData?.data?.snow1 }}</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Overnight snow:</span> peak value</h1>
                    </div>
                </div>

                <!-- cards -->
                <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>monthly snowfall average</h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>tomorrow</h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>next week daily update</h1>
                    </div>
                </div>

                <!-- next 24 hours -->
                <div class="grid gap-4 md:grid-cols-1">
                    <div class="flex gap-4 p-4 border justify-evenly md:grid-cols-1 rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1> next 24 hours</h1>
                    </div>
                </div>

                <!-- detailed -->
                <div class="grid gap-4 md:grid-cols-1">
                    <div class="flex-col gap-4 p-4 border aspect-video justify-evenly md:grid-cols-1 rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="flex gap-2 mb-4">
                            <button
                                v-for="tab in tabs"
                                :key="tab.id"
                                @click="activeTab = tab.id"
                                class="px-4 py-2 transition-colors rounded-lg"
                                :class="{
                                    'bg-blue-600': activeTab === tab.id,
                                    'bg-gray-700 hover:bg-gray-600': activeTab !== tab.id
                                }"
                            >
                                {{ tab.label }}
                            </button>
                        </div>

                        <div class="tab-content">
                            <div v-if="activeTab === 'today'" class="p-4 bg-gray-800 rounded-lg">
                                <h2 class="mb-2 text-xl font-semibold">Today's Detailed Forecast</h2>
                                <p>Temperature range: -°C to -°C</p>
                                <p>Snowfall expected: -cm</p>
                                <p>Wind speed: -km/h</p>
                            </div>

                            <div v-if="activeTab === 'tomorrow'" class="p-4 bg-gray-800 rounded-lg">
                                <h2 class="mb-2 text-xl font-semibold">Tomorrow's Forecast</h2>
                                <p>Temperature range: -°C to -°C</p>
                                <p>Snowfall expected: -cm</p>
                                <p>Wind conditions: -</p>
                            </div>

                            <div v-if="activeTab === 'threeDays'" class="p-4 bg-gray-800 rounded-lg">
                                <h2 class="mb-2 text-xl font-semibold">3-Day Outlook</h2>
                                <div class="grid grid-cols-3 gap-4">
                                    <div v-for="day in 3" :key="day" class="p-2 bg-gray-700 rounded">
                                        <h3>Day {{ day }}</h3>
                                        <p>High: -°C</p>
                                        <p>Low: -°C</p>
                                        <p>Snow: -cm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AppLayout>
</template>
