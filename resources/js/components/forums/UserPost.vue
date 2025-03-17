<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { type Post, type Category, type Comment } from '@/types';
import { Link } from '@inertiajs/vue3';
import { timeAgo, truncateContent } from '@/utils/forums';

const { posts, post, category, userPost, userComments } = defineProps<{
  posts: Post[];
  post: Post | null;
  category: Category | null;
  userPost: Post[] | null;
  userComments: Comment[] | null;
}>();

const selectedTab = ref('posts');
const comments = ref<Comment[]>([]);

onMounted(() => {
  if (userPost && userPost[0]?.user?.id) {
    const userId = userPost[0]?.user?.id;
    fetchUserComments(userId);
  }
});

const fetchUserComments = async (userId: number) => {
  try {
    const response = await axios.get(`/forums/comments/users/${userId}`);
    comments.value = response.data.userComments;
  } catch (error) {
    console.error('Error fetching comments:', error);
  }
};

const toggleTab = (tab: 'posts' | 'comments') => {
  selectedTab.value = tab;
};
</script>

<template>
  <div class="flex flex-col items-center p-8 text-white">
    <div class="sticky top-0 z-10 w-full max-w-4xl py-12 space-y-8 border-b bg-background border-b-gray-700">
      <h1 class="text-4xl font-bold text-center text-red-500">{{ userPost?.[0]?.user?.name }}</h1>
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

    <div class="w-full max-w-4xl mt-8 ">
      <div v-if="selectedTab === 'posts'" class="space-y-8">
        <div v-if="userPost && userPost.length > 0">
          <div v-for="post in userPost" :key="post.id" class="p-6 border border-transparent rounded-lg shadow-lg hover:border-gray-600">
            <Link :href="`/forums/posts/${post.id}`" class="block">
              <div class="flex items-center justify-between pb-4 mt-6 space-x-6">
                <p class="text-sm text-gray-400">{{ timeAgo(post.created_at) }}</p>
                <Link :href="`/forums/categories/${post.category.slug}`">
                <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">{{ post.category?.name }}</p>
                </Link>
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
