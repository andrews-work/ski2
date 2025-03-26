<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
    resort: any;
}>();
</script>

<template>
  <div v-if="resort" class="max-w-4xl p-6 mx-auto rounded-lg shadow-lg">
    <!-- Resort Details Grid -->
    <div class="grid grid-cols-1 gap-4 text-gray-200 md:grid-cols-2 lg:grid-cols-4">
      <!-- Column 1 -->
      <div class="space-y-4">
        <!-- Resort Name -->
        <div>
          <div class="font-medium">Resort Name:</div>
          <div class="font-semibold text-gray-900">{{ resort.name }}</div>
        </div>

        <div>
          <div class="font-medium">Nearest City:</div>
          <div>{{ resort.nearest_city }}</div>
        </div>

      </div>

      <!-- Column 2 -->
      <div class="space-y-4">
        <!-- Peak Elevation -->
        <div>
          <div class="font-medium">Peak Elevation:</div>
          <div>{{ resort.peak_elevation }} m</div>
        </div>

        <!-- Vertical -->
        <div>
          <div class="font-medium">Vertical:</div>
          <div>{{ resort.vertical }}</div>
        </div>
      </div>

      <!-- Column 3 -->
      <div class="space-y-4">
        <div>
          <div class="font-medium">Base Elevation:</div>
          <div>{{ resort.base_elevation }} m</div>
        </div>

        <!-- Skiable Area -->
        <div>
          <div class="font-medium">Skiable Area:</div>
          <div>{{ resort.skiable_area }}</div>
        </div>
      </div>

      <!-- Column 4 -->
      <div class="space-y-4">
        <!-- Website -->
        <div>
          <div class="font-medium">Website:</div>
          <a
            :href="resort.website"
            target="_blank"
            class="text-blue-500 transition duration-200 hover:text-blue-600"
          >
            {{ resort.website }}
          </a>
        </div>

        <!-- Lifts -->
        <div>
          <div class="font-medium">Lifts:</div>
          <div>{{ resort.lifts }}</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Fallback Message -->
  <p v-else class="mt-8 text-center text-gray-600">
    Resort information is not available.
  </p>
</template>
