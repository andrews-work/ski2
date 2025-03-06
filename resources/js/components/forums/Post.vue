<script setup lang="ts">
import { type Post, type Category } from '@/types';
import { onMounted } from 'vue';

defineProps<{
  post: Post;
  category: Category;
}>();

onMounted(() => {
  console.log('PostPage Mounted');
  console.log('Post Data:', post);
  console.log('Category Data:', category);
});
</script>

<template>
  <div class="p-6 rounded-lg shadow-md">
    <h1 class="mb-6 text-2xl font-bold text-center text-white">{{ post.title }}</h1>
    <p class="text-gray-200">{{ post.content }}</p>
    <div class="flex items-center justify-between mt-4 space-x-4">
      <p class="text-sm text-gray-400 hover:text-orange-300">{{ post.user.name }}</p>
      <p class="text-xs text-gray-500">{{ post.created_at }}</p>
      <p class="text-sm text-gray-400 hover:text-orange-300">{{ category.name }}</p>
    </div>
  </div>
</template>



