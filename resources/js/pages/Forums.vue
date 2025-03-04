<script setup lang="ts">
import { defineProps, ref } from 'vue';
import { type Category } from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import { Head } from '@inertiajs/vue3';
import CategoryList from '@/components/forums/CategoryList.vue';
import CategoryPage from '@/components/forums/CategoryPage.vue';
import SubCategoryPage from '@/components/forums/SubCategoryPage.vue';

defineProps({
    categories: {
        type: Array,
        required: true,
    },
    subcategories: {
        type: Array,
        required: true,
    },
    category: {
        type: Object,
        required: false,
    },
    subcategory: {
        type: Object,
        required: false,
    },
    subsubcategories: {
        type: Array,
        required: false,
        default: () => [],
    }
});

// Track the selected category and subcategory
const selectedCategory = ref(null);
const selectedSubCategory = ref(null);

// Function to handle category selection
function selectCategory(category: Category) {
    selectedCategory.value = category;
    // Reset subcategory when selecting a new category
    selectedSubCategory.value = null;
}

// Function to handle subcategory selection
function selectSubCategory(subcategory: Category) {
    selectedSubCategory.value = subcategory;
}

// Breadcrumbs setup
const breadcrumbs = [
    {
        title: 'Forums',
        href: '/forums',
    },
    // Dynamically update based on selected category and subcategory
    ...(selectedCategory.value ? [{ title: selectedCategory.value.name, href: `/forums/categories/${selectedCategory.value.slug}` }] : []),
    ...(selectedSubCategory.value ? [{ title: selectedSubCategory.value.name, href: `/forums/categories/${selectedCategory.value.slug}/${selectedSubCategory.value.slug}` }] : []),
];
</script>

<template>
    <Head title="Forums" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <!-- Content when no category or subcategory is selected -->
        <div v-if="!category && !subcategory" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Placeholder sections -->
            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <h1>most active threads (top 3?)</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <h1>next events</h1>
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <h1>most commented threads</h1>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <div class="relative col-span-2 border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                    <!-- Render CategoryList when no category is selected -->
                    <CategoryList :categories="categories" :subcategories="subcategories" @selectCategory="selectCategory" />
                </div>
                <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70">
                    <h1>postList</h1>
                </div>
            </div>
        </div>

        <!-- Render CategoryPage when a category is selected and no subcategory -->
        <div v-else-if="category && !subcategory" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <CategoryPage :category="category" :subcategories="subcategories" />
        </div>

        <!-- Render SubCategoryPage when a subcategory is selected -->
        <div v-else-if="subcategory" class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <SubCategoryPage :subcategory="subcategory" :subsubcategories="subsubcategories" />
        </div>
    </AppLayout>
</template>
