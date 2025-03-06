<script setup lang="ts">
    import { Button } from '@/components/ui/button';
    import { Link } from '@inertiajs/vue3';

    const navigateToCreatePost = () => {
    Inertia.visit('/forums/post/create');
    };
</script>

<template>
    <div class="flex items-center justify-between h-full mx-auto max-w-7xl">
        <Button @click="navigateToCreatePost" class="bg-transparent border border-green-800 dark:text-white hover:bg-green-800">Create Post</Button>
        <h1>Create</h1>
        <input
            type="text"
            placeholder="Search..."
            class="px-4 py-2 bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <h1>Author</h1>
        <h1>Date</h1>
    </div>
</template>
