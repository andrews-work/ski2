<script setup lang="ts">
import { ref, defineEmits } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { type Comment as CommentType } from '@/types';
import Button from '@/components/ui/button/Button.vue';

const emit = defineEmits(['comment-updated', 'comment-deleted']);

const { comment, postId } = defineProps<{
  comment: CommentType;
  postId: number;
}>();
const userId = comment.user ? comment.user.id : null;

const editableContent = ref(comment.content);
const isEditing = ref(false);

const enterEditMode = () => {
  isEditing.value = true;
};

const cancelEditMode = () => {
  isEditing.value = false;
  editableContent.value = comment.content;
};

const saveChanges = async () => {
  if (!comment.user || !comment.user.id) {
    console.error('User not found for this comment.');
    return;
  }

  try {
    const response = await router.put(`/comments/${comment.id}`, {
      content: editableContent.value,
    });

    comment.content = editableContent.value;

    emit('comment-updated', comment);
    isEditing.value = false;
  } catch (error) {
    console.error('Error updating comment:', error);
  }
};

const deletePost = async () => {
  try {
    await router.delete(`/comments/${comment.id}`);
    emit('comment-deleted', comment.id);
  } catch (error) {
    console.error('Error deleting comment:', error);
  }
};

const isValidDate = (date: string) => {
  return !isNaN(new Date(date).getTime());
};

const timeAgo = (date: string) => {
  if (!isValidDate(date)) return 'Invalid date';

  const commentDate = new Date(date);
  const now = new Date();
  const diffInMs = now.getTime() - commentDate.getTime();
  const diffInHours = diffInMs / (1000 * 60 * 60);

  if (diffInHours < 24) {
    return `${Math.floor(diffInHours)} hours ago`;
  }

  return formatDate(date);
};

const formatDate = (date: string) => {
  const commentDate = new Date(date);
  const day = commentDate.getDate();
  const dayWithSuffix = getDayWithSuffix(day);
  const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  const month = monthNames[commentDate.getMonth()];
  const year = commentDate.getFullYear().toString().slice(-2);
  const hours = commentDate.getHours().toString().padStart(2, '0');
  const minutes = commentDate.getMinutes().toString().padStart(2, '0');

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
  <div class="p-4 mb-6 border-b border-gray-700">
    <div class="flex items-center justify-between">
      <Link
        v-if="comment.user"
        :href="`/forums/posts/users/${comment.user.id}`"
        class="text-sm text-blue-400 hover:text-gray-300"
      >
        {{ comment.user.name }}
      </Link>
      <p class="text-sm text-gray-400">{{ timeAgo(comment.created_at) }}</p>
    </div>

    <div v-if="isEditing" class="mt-4">
      <textarea
        v-model="editableContent"
        rows="3"
        class="w-full px-4 py-2 text-gray-300 bg-transparent rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
      ></textarea>
      <div class="flex justify-end mt-4 space-x-3">
        <Button
          @click="saveChanges"
          variant="outline"
          size="default"
          class="text-green-500 border-green-400"
        >
          Save
        </Button>
        <Button
          @click="cancelEditMode"
          variant="outline"
          size="default"
          class="text-gray-400 border-gray-400"
        >
          Cancel
        </Button>
        <Button
          @click="deletePost"
          variant="outline"
          size="default"
          class="text-red-400 border-red-400"
        >
          Delete
        </Button>
      </div>
    </div>

    <div v-else>
      <p class="mt-4 text-gray-300">{{ comment.content }}</p>
      <div
        v-if="$page.props.auth.user && $page.props.auth.user.id === comment.user_id"
        class="flex justify-end mt-4 space-x-3"
      >
        <Button
          @click="enterEditMode"
          variant="outline"
          size="default"
          class="text-blue-500 border-blue-400"
        >
          Edit
        </Button>
      </div>
    </div>
  </div>
</template>
