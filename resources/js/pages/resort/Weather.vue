<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type WeatherResponse, type WeatherTab, type WeatherTabItem, type Resort, type Country, type Continent } from '@/types';
import { Sunrise, Sunset, Wind } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';
import { getTime12Hour } from '@/utils/date';

const props = defineProps<{
    currentView: string;
    continent: Continent;
    country: Country;
    resort: Resort;
    debug?: boolean;
    weatherData: WeatherResponse;
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
    { title: 'Weather', href: '' },
];

// Tab functionality
const activeTab = ref<WeatherTab>('today');
const tabs: WeatherTabItem[] = [
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
                            <span>{{ getTime12Hour(weatherData?.data?.current?.sunrise) }}</span>
                        </div>

                        <div class="flex items-center gap-2">
                            <Sunset class="w-5 h-5" />
                            <span>{{ getTime12Hour(weatherData?.data?.current?.sunset) }}</span>
                        </div>

                        <h1><span class="text-gray-500 dark:text-gray-400">Temp:</span> {{ weatherData?.data?.current?.temp }} ˚C</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Feels:</span> {{ weatherData?.data?.current?.feels_like }} ˚C</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Visibility:</span> {{ weatherData?.data?.current?.visibility }}m</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">UV Index:</span> {{ weatherData?.data?.current?.uvi }}</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Wind:</span> {{ weatherData?.data?.current?.wind_speed }} km/h</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">24h Snow:</span> {{ weatherData?.data?.current?.daily_snow }} mm</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Snow 1hr:</span> {{ weatherData?.data?.current?.snow1 }}</h1>
                        <h1><span class="text-gray-500 dark:text-gray-400">Overnight snow:</span> </h1>
                    </div>
                </div>

                <!-- cards -->
                <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>monthly snowfall average</h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>tomorrow: morning | afternoon | evening</h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1>next week daily update</h1>
                    </div>
                </div>

                <!-- next 24 hours -->
                <div class="grid gap-4 md:grid-cols-1">
                    <div class="p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <div class="flex gap-4 pb-4 overflow-x-auto">
                            <div v-for="(hour, index) in weatherData?.data?.hourly" :key="index"
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
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <Wind />
                                    </svg>
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
