<script setup lang="ts">
import { ref } from 'vue';

defineProps<{
    resort: any;
}>();

const isExpanded = ref(false);
const toggleExpand = () => {
    isExpanded.value = !isExpanded.value;
};
</script>

<template>
    <div
        class="relative p-4 overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border"
        :class="isExpanded ? 'h-40' : 'h-20'"
    >
        <!-- First Row (always visible) -->
        <div class="absolute top-0 left-0 right-0 flex items-center h-20 p-4 justify-evenly">
            <!-- Title -->
            <h1 class="text-xl font-bold text-white">
                {{ resort.name }}
            </h1>

            <!-- Resort Details -->
            <div class="flex items-center gap-4 text-sm text-gray-300">
                <!-- Altitude -->
                <p>Base 215cm</p>

                <!-- Season Dates -->
                <p>Season 600cm</p>

                <!-- Current Temperature -->
                <p v-if="resort.current_temp !== null && resort.current_temp !== undefined">
                    {{ resort.current_temp }}°C
                </p>
                <p v-else>Temp: 6˚C</p>

                <!-- Total Snowfall -->
                <p v-if="resort.total_snowfall !== null && resort.total_snowfall !== undefined">
                    Snowfall: {{ resort.total_snowfall }}cm
                </p>
                <p v-else>24hrs: 6cm</p>
            </div>

            <!-- Search Bar -->
            <input
                type="text"
                placeholder="Search..."
                class="p-2 text-white placeholder-gray-400 bg-gray-800 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
        </div>

        <!-- Second Row (only shows when expanded) -->
        <div v-if="isExpanded" class="absolute bottom-0 left-0 right-0 flex items-center p-4 h -20 justify-evenly">
            <!-- New content with same spacing -->
            <div></div> <!-- Empty div to match title space -->

            <div class="flex w-full gap-4 text-sm text-gray-300 justify-evenly">
                <div>
                    <p v-if="resort.ski_pass_price">Day Pass: ${{ resort.ski_pass_price }}</p>
                    <p v-else>Day Pass: N/A</p>
                </div>
                <div>
                    <p v-if="resort.open_restaurants">Restaurants Open: {{ resort.open_restaurants }}/30</p>
                    <p v-else>Restaurants: N/A</p>
                </div>
                <div>
                    <p v-if="resort.lifts_open">Lifts Open: {{ resort.lifts_open }}/20</p>
                    <p v-else>Lifts: N/A</p>
                </div>
                <div>
                    <p v-if="resort.snow_condition">Conditions: {{ resort.snow_condition }}</p>
                    <p v-else>Conditions: N/A</p>
                </div>
            </div>

            <div></div> <!-- Empty div to match search bar space -->
        </div>

        <!-- Expand Button -->
        <button
            @click="toggleExpand"
            class="absolute p-1 text-gray-400 rounded-full right-2 top-2 hover:bg-gray-700 hover:text-white"
            :title="isExpanded ? 'Collapse' : 'Expand'"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="20"
                height="20"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                :class="{'rotate-45': isExpanded}"
                class="transition-transform duration-200"
            >
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
        </button>
    </div>
</template>
