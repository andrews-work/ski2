<script setup lang="ts">
import { Post, Category } from '@/types';
import PostListCategory from '@/components/forums/PostListCategory.vue';

const { category, posts } = defineProps<{
    category: Category;
    posts: Post[];
}>();
</script>

<template>
    <PostListCategory :category="category" :posts="posts" />
</template>
