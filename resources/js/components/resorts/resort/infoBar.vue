<script setup lang="ts">
defineProps<{
    resort: any; // Define the resort prop
}>();
</script>

<template>
    <div class="relative flex items-center h-20 p-4 border rounded-xl justify-evenly border-sidebar-border/70 dark:border-sidebar-border">
        <!-- Title -->
        <h1 class="text-xl font-bold text-white">
            {{ resort.name }}
        </h1>

        <!-- Resort Details -->
        <div class="flex items-center gap-4 text-sm text-gray-300">
            <!-- Altitude -->
            <p v-if="resort.altitude">Base: {{ resort.altitude }}m</p>
            <p v-else>Alt: N/A</p>

            <!-- Season Dates -->
            <!-- <p v-if="resort.season_start && resort.season_end">
                Season: {{ resort.season_start }} to {{ resort.season_end }}
            </p> -->
            <p v-else>Season: N/A</p>

            <!-- Current Temperature -->
            <p v-if="resort.current_temp !== null && resort.current_temp !== undefined">
                {{ resort.current_temp }}°C
            </p>
            <p v-else>Temp: N/A</p>

            <!-- Total Snowfall -->
            <p v-if="resort.total_snowfall !== null && resort.total_snowfall !== undefined">
                Snowfall: {{ resort.total_snowfall }}cm
            </p>
            <p v-else>Snowfall: N/A</p>
        </div>

        <!-- Search Bar -->
        <input
            type="text"
            placeholder="Search..."
            class="p-2 text-white placeholder-gray-400 bg-gray-800 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
    </div>
</template>
