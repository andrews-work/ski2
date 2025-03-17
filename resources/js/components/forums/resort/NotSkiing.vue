<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { timeAgo } from '@/utils/forums';

const props = defineProps<{
    category: any;
    continentSlug: string;
    countrySlug: string;
    resortSlug: string;
    notskiingPosts: any[];
}>();
</script>

<template>
    <div class="h-full p-4 rounded-lg shadow-md">

        <Link :href="`/forums/categories/travel/${continentSlug}/${countrySlug}/${resortSlug}/not-skiing`">
            <h2 class="mb-4 text-2xl font-bold text-center text-blue-200 hover:text-white">Not Skiing Activities</h2>


            <div v-if="notskiingPosts.length === 0" class="text-center text-gray-400">
                No not-skiing posts found.
            </div>


            <ul v-else class="space-y-4">
                <li
                    v-for="post in notskiingPosts"
                    :key="post.id"
                    class="p-4 mb-6 transition duration-200 rounded-lg shadow-lg hover:border hover:border-white"
                >
                    <Link :href="`/forums/posts/${post.id}`" class="block">
                        <h1 class="text-xl font-semibold text-white truncate">{{ post.title }}</h1>
                        <p class="my-2 text-sm text-gray-300">{{ post.content }}</p>

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
