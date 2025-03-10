<script setup lang="ts">
import { ref, watch } from 'vue';
import { router } from '@inertiajs/vue3';
import { type Comment as CommentType } from '@/types';
import Comment from '@/components/forums/PostComment.vue';
import { usePage } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
  comments: CommentType[];
  postId: number;
}>();

const isAuthenticated = usePage().props.auth.user !== null;

const newComment = ref('');

const localComments = ref([...props.comments]);

watch(() => props.comments, (newComments) => {
  localComments.value = [...newComments];
}, { deep: true });

const submitNewComment = async () => {
  if (!newComment.value.trim()) {
    return;
  }
  try {
    const response = await router.post(`/posts/${props.postId}/comments`, {
      content: newComment.value,
    });

    if (response && response.comment) {
      localComments.value.push(response.comment);
    } else {
      console.error('Unexpected response structure:', response);
    }

    newComment.value = '';
  } catch (error) {
    console.error('Error creating comment:', error);
    if (error.response && error.response.data.message) {
      alert(`Error: ${error.response.data.message}`);
    } else {
      alert('An error occurred while creating the comment.');
    }
  }
};

const handleCommentDeleted = (commentId: number) => {
  localComments.value = localComments.value.filter(comment => comment.id !== commentId);
};

const handleCommentUpdated = (updatedComment: CommentType) => {
  const index = localComments.value.findIndex(comment => comment.id === updatedComment.id);
  if (index !== -1) {
    localComments.value[index] = updatedComment;
  }
};
</script>

<template>
  <div class="mt-8">
    <h2 class="mb-4 text-lg font-bold text-gray-400">Comments</h2>

    <div v-if="localComments.length > 0">
      <Comment
        v-for="comment in localComments"
        :key="comment.id"
        :comment="comment"
        :postId="postId"
        @comment-deleted="handleCommentDeleted"
        @comment-updated="handleCommentUpdated"
      />
    </div>

    <div v-else class="text-gray-400">
      <p v-if="isAuthenticated">No comments yet. Be the first to comment!</p>
      <p v-else>
        No comments yet. Be the first to comment!
        <Link :href="route('login')" class="text-blue-500 hover:text-blue-400">Login</Link>
      </p>
    </div>

    <div v-if="isAuthenticated" class="p-4 pb-12 mt-6 mb-12">
      <textarea
        v-model="newComment"
        rows="3"
        placeholder="Write a comment..."
        class="w-full px-4 py-2 text-gray-300 bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
      ></textarea>
      <div class="flex justify-end mt-4">
        <button
          @click="submitNewComment"
          class="px-4 py-2 text-blue-500 border border-blue-400 rounded-lg hover:bg-blue-500 hover:text-white"
        >
          Add Comment
        </button>
      </div>
    </div>

    <div v-else class="p-4 pb-12 mt-4 mb-12 rounded-lg">
      <p class="text-gray-400">
        <Link :href="route('login')" class="font-semibold text-blue-500 hover:text-blue-400">
          Login
        </Link>
        to add a comment.
      </p>
    </div>
  </div>
</template>
