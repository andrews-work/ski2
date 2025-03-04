<script setup lang="ts">
import { defineProps } from 'vue';
import { Category } from '@/types';

defineProps<{
    subcategory: Category;
    subsubcategories: Category[];
}>();
</script>

<template>
    <div class="p-6 rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-200">{{ subcategory.name }}</h2>
        <p class="mt-2 text-sm text-gray-200">{{ subcategory.description }}</p>

        <div v-if="subsubcategories.length">
            <ul class="mt-4 space-y-4">
                <li
                    v-for="subsubcategory in subsubcategories"
                    :key="subsubcategory.id"
                    class="p-4 border border-gray-400 rounded-lg"
                >
                    {{ subsubcategory.name }}
                </li>
            </ul>
        </div>
    </div>
</template>