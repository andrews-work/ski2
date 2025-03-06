<script setup lang="ts">
import { onMounted } from 'vue';
import { type Post, type Category } from '@/types'; // Adjust the import path as needed

// Define the props
const { posts, post, category } = defineProps<{
  posts: Post[]; // Add the `posts` prop
  post: Post | null;
  category: Category | null;
}>();

onMounted(() => {
  console.log('UserPosts mounted');
  console.log('Posts:', posts); // Debugging: Check if posts are received
});
</script>
