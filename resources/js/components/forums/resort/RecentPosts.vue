<script setup lang="ts">
import { type Post, type Topic } from '@/types';
import { computed, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { timeAgo, truncateContent, formatDate } from '@/utils/forums';

const props = defineProps<{
    posts: Post[];
    topic?: Topic | null;
}>();

const filteredPosts = computed(() => {
    if (!props.posts) return [];
    if (!props.topic) return props.posts;
    return props.posts.filter(post => post.topic_id === props.topic?.id);
});

const recentPosts = computed(() => {
    return filteredPosts.value.slice(0, 5);
});

onMounted(() => {
    console.log('RecentPosts - posts:', props.posts);
});
</script>

<template>
    <div class="h-full p-4 rounded-lg shadow-md">
        <h2 class="mb-4 text-2xl font-bold text-center text-pink-200 hover:text-white">Recent Posts</h2>
        <ul class="space-y-4">
            <li
                v-for="post in recentPosts"
                :key="post.id"
                class="p-4 mb-6 transition duration-200 rounded-lg shadow-lg hover:border hover:border-white"
            >
                <Link :href="`/forums/posts/${post.id}`" class="block">
                    <h1 class="text-xl font-semibold text-white truncate">{{ truncateContent(post.title, 5) }}</h1>
                    <p class="my-2 text-sm text-gray-300">{{ truncateContent(post.content, 15) }}</p>

                    <div class="flex items-center justify-between mb-2 space-x-4">
                        <Link v-if="post.user && post.user.id" :href="`/forums/posts/users/${post.user.id}`" class="block">
                            <p class="text-sm text-gray-400 hover:text-orange-300">{{ post.user.name }}</p>
                        </Link>
                        <p v-else class="text-sm text-gray-400">Anonymous</p>
                        <p class="text-xs text-gray-500">{{ timeAgo(post.created_at) }}</p>
                    </div>
                </Link>
            </li>
        </ul>
        <p v-if="filteredPosts.length === 0" class="mt-6 text-center text-gray-400">No recent posts available.</p>
    </div>
</template>
