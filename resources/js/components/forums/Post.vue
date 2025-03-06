<script setup lang="ts">
import { type Post, type Category } from '@/types';
import { onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const { post, category } = defineProps<{
  post: Post | null;
  category: Category | null;
}>();

onMounted(() => {
  console.log('PostPage Mounted');
//   console.log('Post Data:', post);
//   console.log('Category Data:', category);
});

const isValidDate = (date: string) => {
  return !isNaN(new Date(date).getTime());
};

const timeAgo = (date: string) => {
  if (!isValidDate(date)) return 'Invalid date';

  const postDate = new Date(date);
  const now = new Date();
  const diffInMs = now.getTime() - postDate.getTime();
  const diffInHours = diffInMs / (1000 * 60 * 60);

  if (diffInHours < 24) {
    return `${Math.floor(diffInHours)} hours ago`;
  }

  return formatDate(date);
};

const formatDate = (date: string) => {
  const postDate = new Date(date);
  const day = postDate.getDate();
  const dayWithSuffix = getDayWithSuffix(day);
  const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const month = monthNames[postDate.getMonth()];
  const year = postDate.getFullYear().toString().slice(-2);
  const hours = postDate.getHours().toString().padStart(2, '0');
  const minutes = postDate.getMinutes().toString().padStart(2, '0');

  // Return formatted date and time
  return `${dayWithSuffix} ${month} ${year} at ${hours}:${minutes}`;
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
</script>

<template>
    <div v-if="post && category" class="p-8 mx-auto text-white shadow-xl max-w-7xl rounded-xl">

        <div class="">
            <Link :href="`/posts/users/${post.user.id}`" class="block">
                <p class="mb-4 text-sm text-purple-500 cursor-pointer hover:text-gray-300">{{ post.user.name }}</p>
            </Link>
        </div>

        <h1 class="mb-8 text-xl font-extrabold text-gray-400 md:text-3xl">{{ post.title }}</h1>
        <div class="py-6 min-h-80 ">
            <p class="leading-relaxed md:text-lg">{{ post.content }}</p>
        </div>
        <div class="flex items-center justify-between pb-4 mt-6 space-x-6 border-b border-b-gray-700">
            <p class="text-xs text-gray-400">{{ timeAgo(post.created_at) }}</p>
            <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">{{ category.name }}</p>
        </div>
    </div>
    <div v-else class="flex items-center justify-center h-full p-6 bg-gray-800 rounded-xl">
        <p class="text-2xl text-gray-400">Loading...</p>
    </div>
</template>

