<script setup lang="ts">
import { onMounted } from 'vue';
import { Category } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    category: Category;
    continents: Category[];
}>();

onMounted(() => {
    console.log('Continents mounted (resorts)');
});
</script>

<template>
    <div class="p-6 rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-200">{{ category.name }}</h2>
        <p class="mt-2 text-sm text-gray-200">{{ category.description }}</p>

        <div v-if="continents && continents.length">
            <ul class="mt-4 space-y-4">
                <li
                    v-for="continent in continents"
                    :key="continent.id"
                    class="p-4 border border-gray-400 rounded-lg"
                >
                    <Link :href="`/forums/categories/resorts/${continent.slug}`" class="block w-full">
                        {{ continent.name }}
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>
