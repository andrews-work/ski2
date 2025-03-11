<script setup lang="ts">
import { ref, computed, onMounted, watch } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { type Category, type Post } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import CategoryList from '@/components/forums/CategoryList.vue';
import PostList from '@/components/forums/PostList.vue';
import PostPage from '@/components/forums/Post.vue';
import UserPostPage from '@/components/forums/UserPost.vue';
import CategoryRouter from '@/components/forums/CategoryRouter.vue';
import ContinentsPage from '@/components/forums/ContinentsPage.vue';
import CountryPage from '@/components/forums/CountryPage.vue';
import ResortPage from '@/components/forums/ResortPage.vue';
import SearchBar from '@/components/forums/Search.vue';
import CreatePost from '@/components/forums/PostCreate.vue';
import PostCategoryList from '@/components/forums/PostCategoryList.vue';

// Define props with default values
const props = withDefaults(defineProps<{
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
    userComments?: Comment[] | null; // Add this line
    createPost?: boolean | null;
}>(), {
    categories: () => [],
    category: null,
    subcategories: () => [],
    subcategory: null,
    continents: () => [],
    continent: null,
    countries: () => [],
    country: null,
    resorts: () => [],
    resort: null,
    posts: () => [],
    post: null,
    userPost: null,
    userComments: null, // Add this line
    createPost: null,
});

const page = usePage();

const selectedCategory = ref<Category | null>(null);
const selectedSubCategory = ref<Category | null>(null);
const selectedCountry = ref<Category | null>(null);
const selectedPost = ref<Post | null>(null);
const selectedPostCategory = ref<Category | null>(null);
const selectedUserPost = ref<Category | null>(null);

function selectCategory(category: Category) {
    selectedCategory.value = category;
    selectedSubCategory.value = null;
    selectedCountry.value = null;
}

function selectSubCategory(subcategory: Category) {
    selectedSubCategory.value = subcategory;
    selectedCountry.value = null;
}

function selectCountry(country: Category) {
    selectedCountry.value = country;
}

function selectPost(post: Post, category: Category) {
    console.log('Selected Post:', post);
    selectedPost.value = post;
    selectedPostCategory.value = category;
}

function resetPost() {
    selectedPost.value = null;
    selectedPostCategory.value = null;
}

function selectUserPost(userPost: Post[]) {
    console.log('Selected User Posts:', userPost);
    selectedUserPost.value = userPost;
}

const breadcrumbs = [
    {
        title: 'Forums',
        href: '/forums',
    },
];

const currentComponent = computed(() => {
    if (props.createPost) return CreatePost;
    if (props.userPost) return UserPostPage;
    if (props.post) return PostPage;
    if (props.resort) return ResortPage;
    if (props.country) return CountryPage;
    if (props.continent) return ContinentsPage;
    if (props.category) return CategoryRouter;
    if (props.category) return PostCategoryList;
    return null;
});

watch(() => page.url, (newUrl) => {
    if (newUrl === '/forums') {
        resetPost();
    }
});
</script>

<template>
    <Head title="Forums" />
    <AppLayout :breadcrumbs="breadcrumbs" class="">

        <!-- Default Forums Page -->
        <div v-if="!currentComponent" class="flex flex-col flex-1 gap-4 p-4 rounded-xl">

            <!-- top row -->
            <div class="grid grid-flow-row gap-4 auto-rows-min md:grid-cols-3 md:grid-rows-1 sm:grid-cols-1 sm:grid-rows-6">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 sm:order-6 md:order-1">
                    <!-- 6 -->
                    <h1>Most active threads (top 3?)</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 sm:order-4 md:order-2">
                    <!-- 4 -->
                    <h1>Next events</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 sm:order-5 md:order-3">
                    <!-- 5 -->
                    <h1>Most commented threads</h1>
                </div>
            </div>

            <!-- middle (search bar) -->
            <div class="grid gap-4 md:grid-cols-1 sm:grid-cols-1 sm:grid-rows-1">
                <div class="relative border rounded-xl border-sidebar-border/70 h-[5vh] sm:order-2 md:order-1">
                    <!-- 2 -->
                    <SearchBar />
                </div>
            </div>

            <!-- bottom -->
            <div class="grid gap-4 md:grid-cols-3 md:grid-rows-1 sm:grid-cols-1 sm:grid-rows-2">
                <div class="relative col-span-2 border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70 sm:order-1 md:order-1">
                    <!-- 1 -->
                    <CategoryList :categories="categories" :subcategories="subcategories" @selectCategory="selectCategory" />
                </div>
                <div class="relative col-span-1 border md:overflow-y-auto h-1/3 rounded-xl border-sidebar-border/70 sm:order-3 md:order-2">
                    <!-- 3 -->
                    <PostList :posts="posts" :categories="categories" @selectPost="selectPost" />
                </div>
            </div>
        </div>

        <!-- Dynamic rendering -->
        <component
            :is="currentComponent"
            v-else
            :category="category"
            :subcategories="subcategories"
            :continents="continents"
            :continent="continent"
            :countries="countries"
            :country="country"
            :resorts="resorts"
            :resort="resort"
            :post="post"
            :categories="categories"
            :posts="posts"
            :userPost="userPost"
            :createPost="createPost"
            :userComments="userComments"
            :errors="$page.props.errors"
            class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl"
        />

    </AppLayout>
</template>
