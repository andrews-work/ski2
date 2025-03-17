<script setup lang="ts">
import { Post } from '@/types';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { formatDate, timeAgo, truncateContent } from '@/utils/forums.ts';

const { posts } = defineProps<{
  posts: Post[];
}>();

onMounted(() => {
  console.log('Posts List Mounted');
});

const logCategory = (categorySlug: string) => {
  console.log('Category clicked:', categorySlug);
};
</script>

<template>
    <div class="p-6 rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-400">Recent Posts</h2>
        <ul class="space-y-4">
            <li
                v-for="post in posts"
                :key="post.id"
                class="p-6 transition-shadow duration-200 border border-gray-700 rounded-lg hover:border-gray-400 hover:shadow-lg"
            >
                <Link :href="`/forums/posts/${post.id}`" class="block">
                    <h1 class="text-xl font-semibold text-gray-400 truncate">{{ truncateContent(post.title, 5) }}</h1>

                    <p class="max-w-full mt-2 text-base text-gray-200 truncate whitespace-nowrap">
                        {{ truncateContent(post.content, 5) }}
                    </p>

                    <div class="flex items-center justify-between mt-4 space-x-4">
                        <Link :href="`/forums/posts/users/${post.user.id}`" class="block">
                            <p class="text-sm text-gray-400 hover:text-orange-300">{{ post.user.name }}</p>
                        </Link>
                        <p class="text-xs text-gray-500">{{ timeAgo(post.created_at) }}</p>
                        <Link :href="`/forums/categories/${post.category.slug}`" @click="logCategory(post.category.slug)" class="block">
                            <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">{{ post.category.name }}</p>
                        </Link>
                    </div>
                </Link>
            </li>
        </ul>
    </div>
</template>
