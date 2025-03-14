<!-- PostList.vue -->
<script setup lang="ts">
import { type Post, type Category } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';

const { category, posts } = defineProps<{
    category: Category;
    posts: Post[];
}>();

const topicId = usePage().url.query.topic || null;
const isLoading = ref(true); // Add a loading state

const filteredPosts = computed(() => {
    if (!topicId || topicId === 'all') return posts;
    return posts.filter(post => post.topic_id === topicId);
});

onMounted(() => {
    console.log('Resort PostList - mounted', props.posts);
    console.log('Category:', props.category);
    console.log('Filtered Posts:', filteredPosts.value);

    // Simulate loading delay (optional, for testing purposes)
    setTimeout(() => {
        isLoading.value = false; // Set loading to false after posts are "loaded"
    }, 1000); // Adjust the timeout as needed
});
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold text-center">{{ category.name }}</h1>

        <!-- Loading state -->
        <div v-if="isLoading" class="text-center text-gray-400">
            Loading posts...
        </div>

        <!-- No posts state -->
        <div v-else-if="!filteredPosts || filteredPosts.length === 0" class="text-center text-gray-400">
            No posts found.
        </div>

        <!-- Render posts -->
        <div v-else>
            <div v-for="post in filteredPosts" :key="post.id" class="p-4 mb-6 transition duration-200 rounded-lg shadow-lg hover:border hover:border-white">
                <p class="text-xl font-semibold text-white truncate">{{ post.title }}</p>
                <p class="my-2 text-sm text-gray-300">{{ post.content }}</p>
                <div class="flex items-center justify-between mb-2 space-x-4">
                    <p v-if="post.user" class="text-sm text-gray-400 hover:text-orange-300">{{ post.user.name }}</p>
                    <p v-else class="text-sm text-gray-400">Anonymous</p>
                    <p class="text-xs text-gray-500">{{ new Date(post.created_at).toLocaleDateString() }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
