<script setup lang="ts">
import { type Post, type Category } from '@/types';
import { computed, onMounted, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import { formatDate, timeAgo, truncateContent } from '@/utils/forums';

const props = defineProps<{
    category: Category;
    posts: Post[];
    continentSlug: string;
    countrySlug: string;
    resortSlug: string;
}>();

const loading = ref(true);

const liveChatPosts = computed(() => {
    if (!props.posts) return [];
    const travelTopic = props.category.topics?.find(topic => topic.name === 'Live Chat');
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
        <Link :href="`/forums/categories/resorts/${continentSlug}/${countrySlug}/${resortSlug}/live-chat`">
            <h2 class="mb-4 text-2xl font-bold text-center text-red-200 hover:text-white">Live Chat</h2>

            <div v-if="loading" class="text-center text-gray-400">
                Loading live chat
            </div>

            <div v-else-if="liveChatPosts.length === 0" class="text-center text-gray-400">
                <h1>chat coming soon</h1>
            </div>

            <ul v-else class="space-y-4">
                <h1>chat coming soon</h1>
            </ul>
        </Link>
    </div>
</template>
