<!-- PostList.vue -->
<script setup lang="ts">
import { type Post, type Category } from '@/types';
import { onMounted, ref } from 'vue';

const isLoading = ref(true); // Define loading state
const filteredPosts = ref<Post[]>([]); // Define filtered posts state

onMounted(() => {
    console.log('Resort PostList - mounted');
    console.log('Filtered Posts:', filteredPosts.value);

    // Simulate loading delay (optional, for testing purposes)
    setTimeout(() => {
        isLoading.value = false; // Set loading to false after posts are "loaded"
    }, 1000); // Adjust the timeout as needed
});
</script>

<template>
    <div>
        <h1 class="text-2xl font-bold text-center">Category Name</h1> <!-- Static placeholder for category name -->

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
            <h1>hewllo</h1>
        </div>
    </div>
</template>
