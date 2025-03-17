<script setup lang="ts">
import { type Post, type Category } from '@/types';
import { computed, onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { timeAgo, truncateContent } from '@/utils/forums';

const props = defineProps<{
    category: Category;
    posts: Post[];
    continentSlug: string;
    countrySlug: string;
    resortSlug: string;
}>();

const loading = ref(true);

const recentCommentsPosts = computed(() => {
    if (!props.posts) return [];
    const travelTopic = props.category.topics?.find(topic => topic.name === 'Recent Comments');
    if (!travelTopic) return [];
    return props.posts.filter(post => post.topic_id === travelTopic.id);
});

onMounted(() => {
    setTimeout(() => {
        loading.value = false;
    }, 1000);
});
</script>

<template>
    <div class="h-full p-4 rounded-lg shadow-md">
        <Link :href="`/forums/categories/resorts/${continentSlug}/${countrySlug}/${resortSlug}/recent-comments`">
            <h2 class="mb-4 text-2xl font-bold text-center text-rose-200 hover:text-white">Recent Comments</h2>

            <div v-if="loading" class="text-center text-gray-400">
                Loading recent comments...
            </div>

            <div v-else-if="recentCommentsPosts.length === 0" class="text-center text-gray-400">
                No recent comments found.
            </div>

            <ul v-else class="space-y-4">
                <li
                    v-for="post in recentCommentsPosts"
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
        </Link>
    </div>
</template>
