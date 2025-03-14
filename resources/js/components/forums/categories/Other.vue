<script setup lang="ts">
import { onMounted } from 'vue';
import { Category } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    category: Category;
    subcategories: Category[];
}>();

onMounted(() => {
    console.log('Other mounted');
});
</script>

<template>
    <div class="p-6 rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-200">{{ category.name }}</h2>
        <p class="mt-2 text-sm text-gray-200">{{ category.description }}</p>

        <div v-if="subcategories.length">
            <ul class="mt-4 space-y-4">
                <li
                    v-for="subcategory in subcategories"
                    :key="subcategory.id"
                    class="p-4 border border-gray-400 rounded-lg"
                >
                    <Link :href="`/forums/categories/other/${subcategory.slug}`" class="block w-full">
                        {{ subcategory.name }}
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>
