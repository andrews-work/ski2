<script setup lang="ts">
import { Link, router, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth.user);

function handleCreatePostClick(event: Event) {
    if (!user.value) {
        event.preventDefault();
        router.visit('/dashboard');
    }
}
</script>

<template>
    <div class="flex items-center justify-between h-full mx-auto max-w-7xl">
        <Link
            :href="`/posts/create`"
            class="px-4 py-2 text-green-400 bg-transparent rounded-lg hover:text-white hover:bg-green-900"
            @click="handleCreatePostClick"
        >
            Create
        </Link>
        <h1>All </h1>
        <input
            type="text"
            placeholder="Search..."
            class="px-4 py-2 text-gray-200 bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
        <h1>Author</h1>
        <h1>Date</h1>
    </div>
</template>
