<script setup lang="ts">
import { type Comment as CommentType } from '@/types';
import { Link } from '@inertiajs/vue3';

const { comment } = defineProps<{
  comment: CommentType;
}>();

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
  <div class="p-4 mb-4 border-b border-gray-700">
    <div class="flex items-center justify-between">
      <Link :href="`/forums/posts/users/${comment.user.id}`" class="text-sm text-blue-400 hover:text-gray-300">
        {{ comment.user.name }}
      </Link>
      <p class="text-sm text-gray-400">{{ timeAgo(comment.created_at) }}</p>
    </div>
    <p class="mt-2 text-gray-300">{{ comment.content }}</p>
  </div>
</template>
