<script setup lang="ts">
import { defineProps } from 'vue';

const props = defineProps<{
    resort: any;
}>();
</script>

<template>
  <div v-if="resort" class="">
    <div><h1>hello</h1></div>
  </div>


  <!-- Fallback Message -->
  <p v-else class="mt-8 text-center text-gray-600">
    Resort information is not available.
  </p>
</template>
