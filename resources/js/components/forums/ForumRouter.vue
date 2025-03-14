<script setup lang="ts">
import { computed } from 'vue';
import { type Category, type Post } from '@/types';
import ContinentsPage from '@/components/forums/ContinentsPage.vue';
import CountryPage from '@/components/forums/CountryPage.vue';
import ResortPage from '@/components/forums/ResortPage.vue';
import PostPage from '@/components/forums/Post.vue';
import UserPostPage from '@/components/forums/UserPost.vue';
import CreatePost from '@/components/forums/PostCreate.vue';
import EventsCategory from '@/components/forums/EventsCategoryPage.vue';
import GearCategory from '@/components/forums/GearCategoryPage.vue';
import TechniqueCategory from '@/components/forums/TechniqueCategoryPage.vue';
import SafetyCategory from '@/components/forums/SafetyCategoryPage.vue';
import OtherCategory from '@/components/forums/OtherCategoryPage.vue';
import CategoryRouter from '@/components/forums/CategoryRouter.vue';
import {
    gearCategories,
    eventsCategories,
    techniqueCategories,
    safetyCategories,
    otherCategories,
} from '@/utils/forumCategories';

const props = defineProps<{
    category?: Category | null;
    subcategory?: Category | null;
    continent?: Category | null;
    country?: Category | null;
    resort?: Category | null;
    post?: Post | null;
    userPost?: Post[] | null;
    createPost?: boolean | null;
}>();

const componentMap = {
    createPost: CreatePost,
    userPost: UserPostPage,
    post: PostPage,
    resort: ResortPage,
    country: CountryPage,
    continent: ContinentsPage,
    events: EventsCategory,
    gear: GearCategory,
    technique: TechniqueCategory,
    safety: SafetyCategory,
    other: OtherCategory,
    default: CategoryRouter,
};

const currentComponent = computed(() => {
    if (props.createPost) return componentMap.createPost;
    if (props.userPost) return componentMap.userPost;
    if (props.post) return componentMap.post;
    if (props.resort) return componentMap.resort;
    if (props.country) return componentMap.country;
    if (props.continent) return componentMap.continent;

    if (props.category) {
        if (eventsCategories.some(event => event.slug === props.category?.slug)) return componentMap.events;
        if (gearCategories.some(gear => gear.slug === props.category?.slug)) return componentMap.gear;
        if (techniqueCategories.some(tech => tech.slug === props.category?.slug)) return componentMap.technique;
        if (safetyCategories.some(safety => safety.slug === props.category?.slug)) return componentMap.safety;
        if (otherCategories.some(other => other.slug === props.category?.slug)) return componentMap.other;
        return componentMap.default;
    }

    return null;
});
</script>

<template>
    <component
        :is="currentComponent"
        v-bind="$props"
    />
</template>
