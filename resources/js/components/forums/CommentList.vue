<script setup lang="ts">
import { type Comment as CommentType } from '@/types';
import Comment from '@/components/forums/PostComment.vue';
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const { comments } = defineProps<{
  comments: CommentType[];
}>();

const isAuthenticated = usePage().props.auth.user !== null;
</script>

<template>
    <div class="mt-8">

        <h2 class="mb-4 text-lg font-bold text-gray-400">Comments</h2>

        <div v-if="comments.length > 0">
            <Comment v-for="comment in comments" :key="comment.id" :comment="comment" />
        </div>

        <div v-else class="text-gray-400">
            <p v-if="isAuthenticated">No comments yet. Be the first to comment!</p>
            <p v-else>
                No comments yet. Be the first to comment!
                <Link :href="route('login')" class="text-blue-500 hover:text-blue-400">Login</Link>
            </p>
        </div>

    </div>
</template>
