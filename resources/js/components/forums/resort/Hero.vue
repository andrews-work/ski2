<script setup lang="ts">
defineProps({
  resort: {
    type: Object,
    required: true,
  },
  country: {
    type: Object,
    required: true,
  },
});
</script>

<template>
    <div class="w-full h-full">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-200">
            {{ resort.name }} <span class="ml-2">{{ country.name }}</span>
        </h2>
    </div>
</template>
