<!-- ResortPage.vue -->
<script setup lang="ts">
import { type Category, type Post, type Topic } from '@/types';
import { computed, onMounted } from 'vue';
import Hero from '@/components/forums/resort/Hero.vue';
import ResortInfo from '@/components/forums/resort/Info.vue';
import RecentPosts from '@/components/forums/resort/RecentPosts.vue';
import AllPosts from '@/components/forums/resort/AllPosts.vue';
import ResortTopicList from '@/components/forums/resort/ResortTopicList.vue'; // Import the ResortTopicList component

// Define props
const props = defineProps<{
    resort: Category;
    topic?: Topic | null;
    posts?: Post[];
    continentSlug: string;
    countrySlug: string;
    resortSlug: string;
}>();

// Lifecycle hook
onMounted(() => {
    console.log('ResortPage - mounted');
});

// Computed property to filter posts by topic
const filteredPosts = computed(() => {
    if (!props.posts) return [];
    if (!props.topic) return props.posts;
    return props.posts.filter(post => post.topic_id === props.topic?.id);
});

// Check if the current URL is the /all route
const isAllPostsRoute = computed(() => {
    return window.location.pathname.includes('/all');
});
</script>

<template>
    <div v-if="resort" class="flex flex-col flex-1 gap-4 p-4 rounded-xl">
        <!-- Hero Section -->
        <div class="flex items-center justify-center h-96">
            <Hero :resort="resort" :country="resort.parent?.parent ?? {}" />
        </div>

        <!-- Resort Info Section -->
        <div class="flex flex-col flex-1 gap-4 rounded-xl">
            <div class="relative h-16 overflow-hidden bg-gray-900 border rounded-xl border-sidebar-border/70">
                <ResortInfo />
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <!-- Recent Posts -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <RecentPosts :posts="filteredPosts" :topic="topic" />
            </div>

            <!-- Recent Comments -->
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Recent Comments</h3>
            </div>

            <!-- Live Chat -->
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Live Chat</h3>
            </div>
        </div>

        <!-- Additional Sections -->
        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Travel</h3>
            </div>
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Restaurants</h3>
            </div>
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Rentals</h3>
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Bars & Clubs</h3>
            </div>
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Rentals</h3>
            </div>
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Shops</h3>
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Local Events</h3>
            </div>
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>News</h3>
            </div>
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Mountain</h3>
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>General</h3>
            </div>
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Non-Skiing Activities</h3>
            </div>
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <AllPosts
                    v-if="!isAllPostsRoute"
                    :category="resort"
                    :posts="posts"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                />
            </div>
        </div>
    </div>

    <!-- Error Message -->
    <div v-else class="text-center text-red-500">
        <p>Resort under construction or not available.</p>
    </div>
</template>
