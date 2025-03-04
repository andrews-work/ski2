<script setup lang="ts">
import { defineProps } from 'vue';
import { Category } from '@/types';

defineProps<{
    category: Category;
    subcategories: Category[];
}>();
</script>

<template>
    <div class="p-6 rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-200">{{ category.name }}</h2>
        <p class="mt-2 text-sm text-gray-200">{{ category.description }}</p>

        <!-- Display Subcategories -->
        <div v-if="subcategories.length">
            <h3 class="mt-4 text-xl font-semibold">Subcategories:</h3>
            <ul class="space-y-2">
                <li
                    v-for="subcategory in subcategories"
                    :key="subcategory.id"
                    class="p-4 border border-gray-400 rounded-lg"
                >
                    {{ subcategory.name }}
                </li>
            </ul>
        </div>
    </div>
</template>
