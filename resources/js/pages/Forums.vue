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
import PostListCategory from '@/components/forums/PostListCategory.vue';
import EventsCategory from '@/components/forums/EventsCategoryPage.vue';
import GearCategory from '@/components/forums/GearCategoryPage.vue';
import GearNestedSubcategory from '@/components/forums/GearNestedSubcategoryPage.vue';
import TechniqueCategory from '@/components/forums/TechniqueCategoryPage.vue';
import SafetyCategory from '@/components/forums/SafetyCategoryPage.vue';
import OtherCategory from '@/components/forums/OtherCategoryPage.vue';
import ResortPostList from '@/components/forums/resort/PostList.vue';

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
    userComments?: Comment[] | null;
    createPost?: boolean | null;
    continentSlug?: string;
    countrySlug?: string;
    resortSlug?: string;
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
    userComments: null,
    createPost: null,
    continentSlug: '',
    countrySlug: '',
    resortSlug: '',
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

const gearCategories = [
    { name: 'Skis', slug: 'skis' },
    { name: 'Race', slug: 'race' },
    { name: 'All Mountain', slug: 'all-mountain' },
    { name: 'Park', slug: 'park' },
    { name: 'Free Ride', slug: 'free-ride' },
    { name: 'Backcountry', slug: 'backcountry' },
    { name: 'X-Country', slug: 'x-country' },
    { name: 'Big Mountain', slug: 'big-mountain' },
    { name: 'Powder', slug: 'powder' },
    { name: 'Snowboards', slug: 'snowboards' },
    { name: 'Split Boards', slug: 'split-boards' },
    { name: 'Powder Snowboards', slug: 'powder-snowboards' },
    { name: 'Park Snowboards', slug: 'park-snowboards' },
    { name: 'Gloves', slug: 'gloves' },
    { name: 'Inners', slug: 'inners' },
    { name: 'Outers', slug: 'outers' },
    { name: 'Clothes', slug: 'clothes' },
    { name: 'Socks', slug: 'socks' },
    { name: 'Jackets', slug: 'jackets' },
    { name: 'Pants', slug: 'pants' },
    { name: 'Thermals', slug: 'thermals' },
    { name: 'Hoodies', slug: 'hoodies' },
    { name: 'Boots', slug: 'boots' },
    { name: 'Après Boots', slug: 'apres-boots' },
    { name: 'Ski Boots', slug: 'ski-boots' },
    { name: 'Snowboard Boots', slug: 'snowboard-boots' },
    { name: 'Bindings', slug: 'bindings' },
    { name: 'Brands', slug: 'brands' },
    { name: 'Poles', slug: 'poles' },
    { name: 'Goggles', slug: 'goggles' },
];

const eventsCategories = [
    { name: 'Free Ride World Tour', slug: 'free-ride-world-tour' },
    { name: 'Alpine', slug: 'alpine' },
    { name: 'Park', slug: 'park' },
    { name: 'X-country', slug: 'x-country' },
];

const techniqueCategories = [
    { name: 'Groomers', slug: 'groomers' },
    { name: 'Skiing', slug: 'skiing' },
    { name: 'Trees', slug: 'trees' },
    { name: 'Powder', slug: 'powder' },
    { name: 'Cliffs', slug: 'cliffs' },
    { name: 'Snowboarding', slug: 'snowboarding' },
    { name: 'Cross Country', slug: 'crosscountry' },
    { name: 'Backcountry', slug: 'backcountry' },
    { name: 'Race', slug: 'race' },
];

const safetyCategories = [
    { name: 'Avalanche Safety', slug: 'avalanche-safety' },
    { name: 'Mountain Safety', slug: 'mountain-safety' },
    { name: 'Resort Safety', slug: 'resort-safety' },
    { name: 'Equipment Safety', slug: 'equipment-safety' },
    { name: 'First Aid', slug: 'first-aid' },
    { name: 'Weather', slug: 'weather' },
];

const otherCategories = [
    { name: 'Suggestions', slug: 'suggestions' },
    { name: 'Epic Pass', slug: 'epic-pass' },
    { name: 'Independant', slug: 'independant' },
    { name: 'Ikon Pass', slug: 'ikon-pass' },
    { name: 'Independant v Ikon v Epic', slug: 'great-debate' },
];

const currentComponent = computed(() => {
    console.log('Current Component Props:', {
        category: props.category,
        subcategory: props.subcategory,
        posts: props.posts,
    });

    if (props.createPost) return CreatePost;
    if (props.userPost) return UserPostPage;
    if (props.post) return PostPage;
    if (props.resort) return ResortPage;
    if (props.country) return CountryPage;
    if (props.continent) return ContinentsPage;

    // Check if the category is a subcategory of "events"
    if (props.category && eventsCategories.some(event => event.slug === props.category.slug)) {
        console.log('Rendering EventsCategory');
        return EventsCategory;
    }

    // Check if the category is a subcategory of "gear"
    if (props.category && gearCategories.some(gear => gear.slug === props.category.slug)) {
        console.log('Rendering GearCategory');
        return GearCategory;
    }

    // Check if the category is a subcategory of "technique"
    if (props.category && techniqueCategories.some(technique => technique.slug === props.category.slug)) {
        console.log('Rendering TechniqueCategory');
        return TechniqueCategory;
    }

    // Check if the category is a subcategory of "safety"
    if (props.category && safetyCategories.some(safety => safety.slug === props.category.slug)) {
        console.log('Rendering SafetyCategory');
        return SafetyCategory;
    }
    if (props.category && otherCategories.some(other => other.slug === props.category.slug)) {
        console.log('Rendering OtherCategory');
        return OtherCategory;
    }

    if (props.category) return CategoryRouter;
    if (props.category) return PostCategoryList;
    if (props.category) return ResortPostList;
    return null;
});

watch(() => page.url, (newUrl) => {
    if (newUrl === '/forums') {
        resetPost();
    }
});

onMounted(() => {
    console.log('Forums component mounted with props:', {
        category: props.category,
        subcategory: props.subcategory,
        posts: props.posts,
    });
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
                    <h1>Most active resorts in last day, week, month, year</h1>
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
            :continentSlug="continentSlug"
            :countrySlug="countrySlug"
            :resortSlug="resortSlug"
            class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl"
        />

    </AppLayout>
</template>
