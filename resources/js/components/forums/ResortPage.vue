<script setup lang="ts">
import { type Category, type Post, type Topic } from '@/types';
import { computed, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

import ResortInfo from '@/components/forums/resort/Info.vue';
import Hero from '@/components/forums/resort/Hero.vue';
import RecentPosts from '@/components/forums/resort/RecentPosts.vue';
import AllPosts from '@/components/forums/resort/AllPosts.vue';


onMounted(() => {
    console.log('ResortPage - mounted');
});

const props = defineProps<{
    resort: Category;
    topic?: Topic | null;
    posts?: Post[];
    continentSlug: string;
    countrySlug: string;
    resortSlug: string;
}>();

const filteredPosts = computed(() => {
    if (!props.posts) return [];
    if (!props.topic) return props.posts;
    return props.posts.filter(post => post.topic_id === props.topic?.id);
});
</script>

<template>
    <div v-if="resort">
        <div class="flex items-center justify-center h-96">
            <Hero :resort="resort" :country="resort.parent?.parent ?? {}" />
        </div>

        <div class="flex flex-col flex-1 gap-4 rounded-xl">
            <div class="relative h-16 overflow-hidden bg-gray-900 border rounded-xl border-sidebar-border/70">
                <ResortInfo />
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <RecentPosts :posts="filteredPosts" :topic="topic" />
            </div>

            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Recent Comments</h3>
            </div>

            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <h3>Live Chat</h3>
            </div>
        </div>

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
                    :category="resort"
                    :posts="posts"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                />
            </div>
        </div>
    </div>

    <div v-else class="text-center text-red-500">
        <p>Resort under construction or not available.</p>
    </div>
</template>
