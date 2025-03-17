<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { type Post, type Category, type Comment } from '@/types';
import CommentList from '@/components/forums/CommentList.vue';
import Button from '@/components/ui/button/Button.vue';
import { formatDate, timeAgo } from '@/utils/forums.ts';

const { post, category } = defineProps<{
    post: Post | null;
    category: Category | null;
}>();

const isEditing = ref(false);
const editableTitle = ref(post?.title || '');
const editableContent = ref(post?.content || '');
const comments = ref<Comment[]>([]);

onMounted(async () => {
    try {
        const response = await fetch(`/posts/${post?.id}/comments`);
        const data = await response.json();
        comments.value = data;
    } catch (error) {
        console.error('Error fetching comments:', error);
    }
});

const enterEditMode = () => {
    isEditing.value = true;
};

const cancelEditMode = () => {
    isEditing.value = false;
    editableTitle.value = post?.title || '';
    editableContent.value = post?.content || '';
};

const saveChanges = async () => {
    try {
        await router.put(`/forums/posts/${post?.id}`, {
            title: editableTitle.value,
            content: editableContent.value,
        });

        isEditing.value = false;
    } catch (error) {
        console.error('Error updating post:', error);
    }
};

const deletePost = (postId: number) => {
    if (confirm('Are you sure you want to delete this post?')) {
        router.delete(`/forums/posts/${postId}`);
    }
};

const logCategory = () => {
    console.log('Category clicked:', category);
};
</script>

<template>
    <div class="flex flex-col items-center justify-center p-8 text-white">
        <div v-if="post && category" class="w-full max-w-4xl space-y-8">
            <div class="">
                <Link :href="`/forums/posts/users/${post.user.id}`" class="block">
                    <p class="mt-8 mb-4 text-yellow-400 cursor-pointer hover:text-gray-300">{{ post.user.name }}</p>
                </Link>
            </div>

            <h1 v-if="!isEditing" class="mt-8 mb-8 text-xl font-extrabold text-gray-400 md:text-3xl">{{ post.title }}</h1>
            <input
                v-else
                v-model="editableTitle"
                type="text"
                class="w-full px-4 py-2 mt-8 mb-8 text-xl font-extrabold text-gray-400 bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 md:text-3xl"
            />

            <div v-if="!isEditing" class="py-6 min-h-80">
                <p class="leading-relaxed md:text-lg">{{ post.content }}</p>
            </div>
            <textarea
                v-else
                v-model="editableContent"
                rows="5"
                class="w-full px-4 py-2 leading-relaxed text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 md:text-lg"
            ></textarea>

            <div class="flex items-center justify-between pb-4 mt-6 space-x-6 border-b border-b-gray-700">
                <p class="text-sm text-gray-400">{{ timeAgo(post.created_at) }}</p>
                <Link :href="`/forums/categories/${category.slug}`" @click="logCategory" class="block">
                    <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">{{ category.name }}</p>
                </Link>
            </div>

            <div v-if="$page.props.auth.user && $page.props.auth.user.id === post.user_id">
                <div v-if="isEditing" class="flex space-x-4">
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
                        @click="deletePost(post.id)"
                        variant="outline"
                        size="default"
                        class="text-red-400 border-red-400"
                    >
                        Delete
                    </Button>
                </div>

                <div v-else class="flex space-x-4">
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

            <div class="">
                <CommentList :comments="comments" :postId="post.id" />
            </div>
        </div>

        <div v-else class="flex items-center justify-center h-full p-6 bg-gray-800 rounded-xl">
            <p class="text-2xl text-gray-400">Loading...</p>
        </div>
    </div>
</template>
