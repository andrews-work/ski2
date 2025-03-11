<script setup lang="ts">
import { type Post, type Category } from '@/types';

const { category, posts } = defineProps<{
    category: Category;
    posts: Post[];
}>();
</script>

<template>
    <div class="flex flex-col items-center justify-center p-8 text-white">
        <div v-if="category" class="w-full max-w-4xl space-y-8">
            <!-- Category Name -->
            <h1 class="text-2xl font-bold">{{ category.name }}</h1>

            <!-- List of Posts -->
            <div v-if="posts.length">
                <div v-for="post in posts" :key="post.id" class="p-4 mb-4 bg-gray-800 rounded-lg">
                    <h2 class="text-lg font-semibold">{{ post.title }}</h2>
                    <p class="text-gray-400">{{ post.content }}</p>
                    <p class="text-sm text-gray-500">Posted by: {{ post.user.name }}</p>
                </div>
            </div>
            <div v-else>
                <p class="text-gray-400">No posts available in this category.</p>
            </div>
        </div>

        <!-- Loading State -->
        <div v-else class="flex items-center justify-center h-full p-6 bg-gray-800 rounded-xl">
            <p class="text-2xl text-gray-400">Loading...</p>
        </div>
    </div>
</template>
