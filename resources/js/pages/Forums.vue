<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { type Category, type Post } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import CategoryList from '@/components/forums/CategoryList.vue';
import PostList from '@/components/forums/PostList.vue';
import PostPage from '@/components/forums/Post.vue';
import CategoryRouter from '@/components/forums/CategoryRouter.vue';
import ContinentsPage from '@/components/forums/ContinentsPage.vue';
import CountryPage from '@/components/forums/CountryPage.vue';
import ResortPage from '@/components/forums/ResortPage.vue';
import SearchBar from '@/components/forums/Search.vue';

const props = defineProps({
  categories: Array,
  category: Object,

  subcategories: Array,
  subcategory: Object,

  continents: Array,
  continent: Object,

  countries: Array,
  country: Object,

  resorts: Array,
  resort: Object,

  posts: Array,
  post: Object,
});

onMounted(() => {
  console.log('Forums.vue mounted');
});

const selectedCategory = ref<Category | null>(null);
const selectedSubCategory = ref<Category | null>(null);
const selectedCountry = ref<Category | null>(null);
const selectedPost = ref<Post | null>(null);
const selectedPostCategory = ref<Category | null>(null);

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

const breadcrumbs = [
  {
    title: 'Forums',
    href: '/forums',
  },
];
</script>

<template>
  <Head title="Forums" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <!-- Default Forums Page -->
    <div v-if="!category && !subcategory && !continent && !country" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
      <div class="grid gap-4 auto-rows-min md:grid-cols-3">
        <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
          <h1>Most active threads (top 3?)</h1>
        </div>
        <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
          <h1>Next events</h1>
        </div>
        <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
          <h1>Most commented threads</h1>
        </div>
      </div>
      <div class="grid gap-4 md:grid-cols-1">
        <div class="relative border rounded-xl border-sidebar-border/70 h-[5vh]">
            <SearchBar />
        </div>
      </div>
      <div class="grid gap-4 md:grid-cols-3">
        <div class="relative col-span-2 border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
          <CategoryList :categories="categories" :subcategories="subcategories" @selectCategory="selectCategory" />
        </div>
        <div class="relative col-span-1 border md:overflow-y-auto h-1/3 rounded-xl border-sidebar-border/70">
          <PostList :posts="posts" :categories="categories" @selectPost="selectPost" />
        </div>
      </div>
    </div>

    <!-- Category Page (e.g., Resorts) -->
    <div v-else-if="category && !subcategory && !continent && !country && !resort" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
      <CategoryRouter :category="category" :subcategories="subcategories" :continents="continents" />
    </div>

    <!-- Continents Page -->
    <div v-else-if="continent && !country && !resort" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
      <ContinentsPage :continent="continent" :countries="countries" />
    </div>

    <!-- Country Page -->
    <div v-else-if="country && !resort" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
      <CountryPage :continent="continent" :country="country" :resorts="resorts" />
    </div>

    <!-- Resort Page -->
    <div v-else-if="resort" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
      <ResortPage :resort="resort" :resorts="resorts" :country="country" />
    </div>

    <!-- Post page -->
    <div v-else-if="post" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
        <PostPage :post="post" :category="post.category" />
    </div>
  </AppLayout>
</template>
