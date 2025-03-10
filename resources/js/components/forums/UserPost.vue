<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { type Post, type Category, type Comment } from '@/types';
import { Link } from '@inertiajs/vue3';
import axios from 'axios'; // Assuming axios is installed for HTTP requests

const { posts, post, category, userPost, userComments } = defineProps<{
  posts: Post[];
  post: Post | null;
  category: Category | null;
  userPost: Post[] | null;
  userComments: Comment[] | null;
}>();

const selectedTab = ref('posts');
const comments = ref<Comment[]>([]); // Local ref to hold the comments

onMounted(() => {
  console.log('UserPosts mounted');
  console.log('User Posts:', userPost);

  // If userPost exists and has a userId, fetch comments
  if (userPost && userPost[0]?.user?.id) {
    const userId = userPost[0]?.user?.id;
    fetchUserComments(userId);
  }
});

const fetchUserComments = async (userId: number) => {
  try {
    const response = await axios.get(`/forums/comments/users/${userId}`);
    comments.value = response.data.userComments;
    console.log('Fetched comments:', comments.value);
  } catch (error) {
    console.error('Error fetching comments:', error);
  }
};

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

const toggleTab = (tab: 'posts' | 'comments') => {
  selectedTab.value = tab;
};
</script>

<template>
  <div class="flex flex-col items-center p-8 text-white">
    <!-- Header (Sticky) -->
    <div class="sticky top-0 z-10 w-full max-w-4xl py-12 space-y-8 border-b border-b-gray-700">
      <h1 class="text-4xl font-bold text-center text-red-500">{{ userPost?.[0]?.user?.name }}</h1>

      <!-- Tabs to toggle between posts and comments -->
      <div class="flex justify-center space-x-8">
        <button
          :class="{'text-gray-300 border-b-2 border-red-500': selectedTab === 'posts'}"
          @click="toggleTab('posts')"
          class="text-xl font-medium hover:text-red-300"
        >
          Posts
        </button>
        <button
          :class="{'text-gray-300 border-b-2 border-red-500': selectedTab === 'comments'}"
          @click="toggleTab('comments')"
          class="text-xl font-medium hover:text-red-300"
        >
          Comments
        </button>
      </div>
    </div>

    <!-- Content Section -->
    <div class="w-full max-w-4xl mt-8 ">
      <!-- Show posts or comments based on selected tab -->
      <div v-if="selectedTab === 'posts'" class="space-y-8">
        <div v-if="userPost && userPost.length > 0">
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

      <!-- Show comments if selected -->
      <div v-else-if="selectedTab === 'comments'" class="space-y-8">
        <div v-if="comments.length > 0">
          <div v-for="comment in comments" :key="comment.id" class="p-6 border border-transparent rounded-lg shadow-lg hover:border-gray-600">
            <div class="flex items-center justify-between pb-4 mt-6 space-x-6">
              <p class="text-sm text-gray-400">{{ timeAgo(comment.created_at) }}</p>
            </div>
            <p class="text-lg text-gray-400">{{ comment.content }}</p>
          </div>
        </div>
        <div v-else class="text-center">
          <p class="text-xl text-gray-400">No comments found for this user.</p>
        </div>
      </div>

    </div>
  </div>
</template>
