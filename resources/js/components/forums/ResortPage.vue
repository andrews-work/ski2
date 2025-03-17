<script setup lang="ts">
import { ref } from 'vue';
import { type Category, type Post, type Topic } from '@/types';
import { computed, onMounted } from 'vue';
import axios from 'axios';

// Components
import Hero from '@/components/forums/resort/Hero.vue';
import ResortInfo from '@/components/forums/resort/Info.vue';

import AllPosts from '@/components/forums/resort/AllPosts.vue';
import RecentPosts from '@/components/forums/resort/RecentPosts.vue';
import RecentComments from '@/components/forums/resort/RecentComments.vue';
import LiveChat from '@/components/forums/resort/LiveChat.vue';

import Travel from '@/components/forums/resort/Travel.vue';
import Restaurants from '@/components/forums/resort/Restaurants.vue';
import Bars from '@/components/forums/resort/Bars.vue';
import Rentals from '@/components/forums/resort/Rentals.vue';
import Shops from '@/components/forums/resort/Shops.vue';
import Events from '@/components/forums/resort/Events.vue';
import News from '@/components/forums/resort/News.vue';
import Mountain from '@/components/forums/resort/Mountain.vue';
import NotSkiing from '@/components/forums/resort/NotSkiing.vue';
import Backcountry from '@/components/forums/resort/Backcountry.vue';
import Suggestions from '@/components/forums/resort/Suggestions.vue';
import Park from '@/components/forums/resort/Park.vue';
import General from '@/components/forums/resort/General.vue';

// Props
const props = defineProps<{
    resort: Category;
    continentSlug: string;
    countrySlug: string;
    resortSlug: string;
    posts?: Post[];
    topic?: Topic | null;
    loading?: boolean;
    error?: string | null;
}>();

// state
const loading = ref(props.loading || false);
const error = ref(props.error || null);

// Data
const travelPosts = ref<Post[]>([]);
const restaurantPosts = ref<Post[]>([]);
const barPosts = ref<Post[]>([]);
const rentalsPosts = ref<Post[]>([]);
const shopsPosts = ref<Post[]>([]);
const eventsPosts = ref<Post[]>([]);
const newsPosts = ref<Post[]>([]);
const generalPosts = ref<Post[]>([]);
const mountainPosts = ref<Post[]>([]);
const notskiingPosts = ref<Post[]>([]);
const parkPosts = ref<Post[]>([]);
const backcountryPosts = ref<Post[]>([]);
const suggestionsPosts = ref<Post[]>([]);

// Fetch all posts
const fetchPosts = async () => {
    try {
        loading.value = true;
        error.value = null;

        // Fetch all posts for the resort
        const responses = await Promise.all([
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/travel/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/restaurants/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/bars/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/rentals/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/shops/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/events/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/news/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/mountain/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/general/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/not-skiing/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/park/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/backcountry/posts`),
            axios.get(`/forums/categories/resorts/${props.continentSlug}/${props.countrySlug}/${props.resortSlug}/suggestions/posts`),
        ]);

        // Assign fetched data to state
        travelPosts.value = responses[0].data?.travelPosts || [];
        restaurantPosts.value = responses[1].data?.restaurantPosts || [];
        barPosts.value = responses[2].data?.barPosts || [];
        rentalsPosts.value = responses[3].data?.rentalsPosts || [];
        shopsPosts.value = responses[4].data?.shopsPosts || [];
        eventsPosts.value = responses[5].data?.eventsPosts || [];
        newsPosts.value = responses[6].data?.newsPosts || [];
        mountainPosts.value = responses[7].data?.mountainPosts || [];
        notskiingPosts.value = responses[8].data?.notskiingPosts || [];
        generalPosts.value = responses[9].data?.generalPosts || [];
        parkPosts.value = responses[10].data?.parkPosts || [];
        backcountryPosts.value = responses[11].data?.backcountryPosts || [];
        suggestionsPosts.value = responses[12].data?.suggestionsPosts || [];

    } catch (err) {
        error.value = 'Failed to fetch posts. Please try again later.';
        console.error('Error fetching posts:', err);
    } finally {
        loading.value = false;
    }
};

const filteredPosts = computed(() => {
    if (!props.posts) return [];
    if (!props.topic) return props.posts;
    return props.posts.filter(post => post.topic_id === props.topic?.id);
});

// Fetch data on mount
onMounted(() => {
    console.log('ResortPage - mounted');
    fetchPosts();
});

// Utility function for route checks
const createRouteCheck = (routeName: string) => {
    return computed(() => window.location.pathname.includes(`/${routeName}`));
};

// Route checks
const isAllPostsRoute = createRouteCheck('all');
const isTravelRoute = createRouteCheck('travel');
const isRestaurantRoute = createRouteCheck('restaurants');
const isRentalsRoute = createRouteCheck('rentals');
const isBarRoute = createRouteCheck('bars');
const isShopsRoute = createRouteCheck('shops');
const isEventsRoute = createRouteCheck('events');
const isNewsRoute = createRouteCheck('news');
const isMountainRoute = createRouteCheck('mountain');
const isNotSkiingRoute = createRouteCheck('not-skiing');
const isParkRoute = createRouteCheck('park');
const isGeneralRoute = createRouteCheck('general');
const isBackcountryRoute = createRouteCheck('backcountry');
const isSuggestionsRoute = createRouteCheck('suggestions');
</script>

<template>
    <div v-if="resort" class="flex flex-col flex-1 gap-4 p-4 rounded-xl">
        <!-- Hero Section -->
        <div class="flex items-center justify-center h-96">
            <Hero :resort="resort" :country="resort.parent?.parent ?? {}" />
        </div>

        <div class="flex flex-col flex-1 gap-4 rounded-xl">
            <div class="relative h-16 overflow-hidden bg-gray-900 border rounded-xl border-sidebar-border/70">
                <ResortInfo />
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <!-- Recent Posts -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <RecentPosts :posts="filteredPosts" :topic="topic" />
            </div>

            <!-- Recent Comments -->
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <RecentComments :category="resort" :posts="filteredPosts" />
            </div>

            <!-- Live Chat -->
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                <LiveChat />
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <!-- Travel -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Travel
                    v-if="!isTravelRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :travelPosts="travelPosts"
                />
            </div>
            <!-- Restaurants -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Restaurants
                    v-if="!isRestaurantRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :restaurantPosts="restaurantPosts"
                />
            </div>
            <!-- Rentals -->
            <div class="relative overflow-hidden border md:overflow-y-autoaspect-video rounded-xl border-sidebar-border/70">
                <Rentals
                    v-if="!isRentalsRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :rentalsPosts="rentalsPosts"
                />
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <!-- Bars -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Bars
                    v-if="!isBarRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :barPosts="barPosts"
                />
            </div>
            <!-- Park -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Park
                    v-if="!isParkRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :parkPosts="parkPosts"
                />
            </div>
            <!-- Shops -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Shops
                    v-if="!isShopsRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :shopsPosts="shopsPosts"
                />
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <!-- Events -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Events
                    v-if="!isEventsRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :eventsPosts="eventsPosts"

                />
            </div>
            <!-- News -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <News
                    v-if="!isNewsRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :newsPosts="newsPosts"
                />
            </div>
            <!-- Mountain -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Mountain
                    v-if="!isMountainRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :mountainPosts="mountainPosts"
                />
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <!-- General -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <General
                    v-if="!isGeneralRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :generalPosts="generalPosts"
                />
            </div>
            <!-- Non-Skiing -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <NotSkiing
                    v-if="!isNotSkiingRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :notskiingPosts="notskiingPosts"
                />
            </div>
            <!-- All Posts -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <AllPosts
                v-if="!isAllPostsRoute"
                :category="resort"
                :posts="posts"
                :continentSlug="continentSlug"
                :countrySlug="countrySlug"
                :resortSlug="resortSlug"
                :loading="loading"
                :error="error"
                />
            </div>
        </div>

        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <!-- Backcountry -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Backcountry
                    v-if="!isBackcountryRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :backcountryPosts="backcountryPosts"
                />
            </div>
            <!-- Suggestions -->
            <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70">
                <Suggestions
                    v-if="!isSuggestionsRoute"
                    :category="resort"
                    :continentSlug="continentSlug"
                    :countrySlug="countrySlug"
                    :resortSlug="resortSlug"
                    :suggestionsPosts="suggestionsPosts"
                />
            </div>
            <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
            </div>
        </div>
    </div>

    <div v-else class="text-center text-red-500">
        <p>Resort under construction or not available.</p>
    </div>
</template>
