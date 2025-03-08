<script setup lang="ts">
import { Category } from '@/types';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

defineProps<{
    categories: Category[];
    subcategories: Category[];
}>();

onMounted(() => {
    console.log('CategoryList - mounted');
})

</script>

<template>
    <div class="p-6 rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-400">Categories</h2>
        <ul class="space-y-4">
            <li
                v-for="category in categories"
                :key="category.id"
                class="p-6 transition-shadow duration-200 border border-gray-800 rounded-lg hover:border-gray-500 hover:shadow-lg"
            >
                <Link :href="`/forums/categories/${category.slug}`" class="block w-full">
                    <div>
                        <div class="flex flex-col sm:flex-row">
                            <h3 class="text-xl font-semibold text-gray-400">{{ category.name }}</h3>
                            <p class="mt-2 text-sm text-gray-200 place-content-end sm:ml-5">{{ category.description }}</p>
                        </div>

                        <div v-if="subcategories.length">
                            <ul class="flex flex-col mt-4 mb-4 overflow-x-auto sm:flex-row sm:space-x-6 md:space-x-0 sm:overflow-x-auto whitespace-nowrap sm:w-full">
                                <li
                                    v-for="(subcategory, index) in subcategories.filter(sub => sub.parent_id === category.id)"
                                    :key="subcategory.id"
                                    class="text-sm text-gray-400 cursor-pointer hover:text-blue-500 min-w-max"
                                >
                                    <Link :href="`/forums/categories/${category.slug}/${subcategory.slug}`" class="">
                                        {{ subcategory.name }}
                                    </Link>
                                    <span v-if="index !== subcategories.filter(sub => sub.parent_id === category.id).length - 1" class="mx-4 text-gray-400">|</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </Link>
            </li>
        </ul>
    </div>
</template>
