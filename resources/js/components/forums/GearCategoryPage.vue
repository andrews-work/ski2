<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { type Post, type Category } from '@/types';

const { category, subcategories, posts } = defineProps<{
    category: Category;
    subcategories?: Category[];
    posts?: Post[];
}>();

const loading = ref(true);

onMounted(() => {
    console.log('Gear Category - mounted');

    setTimeout(() => {
        loading.value = false;
    }, 300);
});
</script>

<template>
    <div class="flex flex-col items-center p-8 text-white">
        <!-- Category Section (Sticky) -->
        <div class="sticky top-0 z-10 w-full max-w-4xl py-12 space-y-8 border-b border-b-gray-700">
            <h1 class="text-4xl font-bold text-center ">{{ category?.name }}</h1>
        </div>

        <!-- Display subcategories if available -->
        <div v-if="subcategories && subcategories.length && !posts" class="w-full max-w-4xl mt-8 space-y-8">
            <ul class="mt-4 space-y-4">
                <li
                    v-for="subcategory in subcategories"
                    :key="subcategory.id"
                    class="p-4 border border-gray-400 rounded-lg"
                >
                    <Link :href="`/forums/categories/gear/${category.slug}/${subcategory.slug}`" class="block w-full">
                        {{ subcategory.name }}
                    </Link>
                </li>
            </ul>
        </div>

        <!-- Display posts if available -->
        <div v-else-if="category && !loading && posts?.length" class="w-full max-w-4xl mt-8 space-y-8">
            <div v-for="post in posts" :key="post.id" class="p-6 border border-transparent rounded-lg shadow-lg hover:border-gray-600">
                <div class="flex items-center justify-between pb-4 mt-6 space-x-6">
                    <p class="text-sm text-gray-400">{{ post.created_at }}</p>
                    <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">{{ post.category?.name }}</p>
                </div>

                <h2 class="text-2xl font-semibold text-gray-200">{{ post.title }}</h2>
                <p class="mt-4 text-lg text-gray-400">{{ post.content }}</p>
            </div>
        </div>

        <!-- No posts message (only when not loading and no posts) -->
        <div v-else-if="category && !loading && (!posts || posts.length === 0)" class="flex items-center justify-center h-full p-6 text-center">
            <p class="text-xl text-gray-400">No posts available in this category.</p>
        </div>

        <!-- Loading state (only when still loading) -->
        <div v-else class="flex items-center justify-center h-full p-6 rounded-xl">
            <p class="text-2xl text-gray-400">Loading...</p>
        </div>
    </div>
</template>
