<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { type Category, type Post } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import CategoryList from '@/components/forums/CategoryList.vue';
import PostList from '@/components/forums/PostList.vue';
import SearchBar from '@/components/forums/Search.vue';
import ForumRouter from '@/components/forums/ForumRouter.vue';

const props = defineProps<{
    categories?: Category[];
    category?: Category | null;
    subcategories?: Category[];
    subcategory?: Category | null;
    continents?: Category[];
    continent?: Category | null;
    countries?: Category[];
    country?: Category | null;
    resorts?: Category[];
    resort?: Category | null;
    posts?: Post[];
    post?: Post | null;
    userPost?: Post[] | null;
    userComments?: Comment[] | null;
    createPost?: boolean | null;
    continentSlug?: string;
    countrySlug?: string;
    resortSlug?: string;
}>();

const page = usePage();
const breadcrumbs = [{ title: 'Forums', href: '/forums' }];
</script>

<template>
    <Head title="Forums" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Default Forums Page -->
        <div v-if="!category && !post && !userPost && !createPost" class="flex flex-col flex-1 gap-4 p-4 rounded-xl">
            <!-- Top Row -->
            <div class="grid grid-flow-row gap-4 auto-rows-min md:grid-cols-3 md:grid-rows-1 sm:grid-cols-1 sm:grid-rows-6">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 sm:order-6 md:order-1">
                    <h1>Most active threads (top 3?)</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 sm:order-4 md:order-2">
                    <h1>Next events</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 sm:order-5 md:order-3">
                    <h1>Most active resorts in last day, week, month, year</h1>
                </div>
            </div>

            <!-- Middle (Search Bar) -->
            <div class="grid gap-4 md:grid-cols-1 sm:grid-cols-1 sm:grid-rows-1">
                <div class="relative border rounded-xl border-sidebar-border/70 h-[5vh] sm:order-2 md:order-1">
                    <SearchBar />
                </div>
            </div>

            <!-- Bottom -->
            <div class="grid gap-4 md:grid-cols-3 md:grid-rows-1 sm:grid-cols-1 sm:grid-rows-2">
                <div class="relative col-span-2 border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70 sm:order-1 md:order-1">
                    <CategoryList :categories="categories" :subcategories="subcategories" />
                </div>
                <div class="relative col-span-1 border md:overflow-y-auto h-1/3 rounded-xl border-sidebar-border/70 sm:order-3 md:order-2">
                    <PostList :posts="posts" :categories="categories" />
                </div>
            </div>
        </div>

        <!-- Dynamic Rendering -->
        <ForumRouter v-else v-bind="$props" />
    </AppLayout>
</template>
