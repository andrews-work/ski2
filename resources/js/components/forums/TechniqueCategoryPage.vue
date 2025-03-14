<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { type Post, type Category } from '@/types';

const { category, posts } = defineProps<{
    category: Category;
    posts: Post[];
}>();

const loading = ref(true);

onMounted(() => {
    console.log('Technique Category Page- mounted');

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

        <!-- Posts Section -->
        <div v-if="category && !loading && posts.length" class="w-full max-w-4xl mt-8 space-y-8">
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
        <div v-else-if="category && !loading && posts.length === 0" class="flex items-center justify-center h-full p-6 text-center">
            <p class="text-xl text-gray-400">No posts available in this category.</p>
        </div>

        <!-- Loading state (only when still loading) -->
        <div v-else class="flex items-center justify-center h-full p-6 rounded-xl">
            <p class="text-2xl text-gray-400">Loading...</p>
        </div>
    </div>
</template>
