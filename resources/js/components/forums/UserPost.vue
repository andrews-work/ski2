<script setup lang="ts">
import { onMounted } from 'vue';
import { type Post, type Category } from '@/types';
import { Link } from '@inertiajs/vue3';

const { posts, post, category, userPost } = defineProps<{
  posts: Post[];
  post: Post | null;
  category: Category | null;
  userPost: Post[] | null;
}>();

onMounted(() => {
  console.log('UserPosts mounted');
  console.log('User Posts:', userPost);
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
    <div class="flex flex-col items-center justify-center min-h-screen p-8 text-white">

        <div v-if="userPost" class="w-full max-w-4xl space-y-8">

            <!-- Add more spacing here using padding or margin -->
            <div class="py-12 border-b border-b-gray-700"> <!-- Increased padding-top and padding-bottom -->
                <h1 class="text-4xl font-bold text-center text-red-500">{{ userPost[0]?.user?.name }}</h1>
            </div>

            <div v-for="post in userPost" :key="post.id" class="p-6 border border-transparent rounded-lg shadow-lg hover:border-gray-600">
                <Link :href="`/forums/posts/${post.id}`" class="block">
                    <div class="flex items-center justify-between pb-4 mt-6 space-x-6">
                        <p class="text-sm text-gray-400">{{ timeAgo(post.created_at) }}</p>
                        <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">{{ post.category?.name }}</p>
                    </div>

                    <h2 class="text-2xl font-semibold text-gray-200">{{ post.title }}</h2>
                    <p class="mt-4 text-lg text-gray-400">{{ post.content }}</p>
                </Link>
            </div>
        </div>

        <div v-else class="text-center">
            <p class="text-xl text-gray-400">No posts found for this user.</p>
        </div>

    </div>
</template>