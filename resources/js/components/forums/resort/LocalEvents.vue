<script setup lang="ts">
import { type Category, type Post } from '@/types';

const props = defineProps<{
    category: Category;
    posts: Post[];
}>();

console.log('LocalEvents Props:', props);
</script>

<template>
    <div>
        <h1>Local Events</h1>
        <div v-if="posts.length">
            <div v-for="post in posts" :key="post.id">
                <h2>{{ post.title }}</h2>
                <p>{{ post.content }}</p>
            </div>
        </div>
        <div v-else>
            <p>No posts available.</p>
        </div>
    </div>
</template>
