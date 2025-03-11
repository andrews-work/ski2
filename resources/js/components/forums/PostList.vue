<script setup lang="ts">
import { Post, Category } from '@/types';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const { posts } = defineProps<{
  posts: Post[];
}>();

onMounted(() => {
  console.log('Posts List Mounted');
});

const truncateContent = (content: string, wordLimit: number) => {
  const words = content.split(' ');
  return words.slice(0, wordLimit).join(' ') + (words.length > wordLimit ? '...' : '');
};

const getDayWithSuffix = (day: number) => {
  if (day >= 11 && day <= 13) return `${day}th`;
  switch (day % 10) {
    case 1: return `${day}st`;
    case 2: return `${day}nd`;
    case 3: return `${day}rd`;
    default: return `${day}th`;
  }
};

const formatDate = (date: string) => {
  const postDate = new Date(date);
  const day = postDate.getDate();
  const dayWithSuffix = getDayWithSuffix(day);
  const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const month = monthNames[postDate.getMonth()];
  const year = postDate.getFullYear().toString().slice(-2);

  return `${dayWithSuffix} ${month} ${year}`;
};

const timeAgo = (date: string) => {
  const postDate = new Date(date);
  const now = new Date();
  const diffInMs = now.getTime() - postDate.getTime();
  const diffInHours = diffInMs / (1000 * 60 * 60);

  if (diffInHours < 24) {
    return `${Math.floor(diffInHours)} hours ago`;
  }

  return formatDate(date);
};

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
