<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ref } from 'vue';

const props = defineProps<{
    currentView: string;
    continent?: any;
    country?: any;
    state?: any;
    town?: any;
    resort?: any;
    category?: any;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.state.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}` },
    { title: props.town.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}` },
    { title: props.category.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}/${props.category.slug}` },
];

const activeTab = ref('latest');
const newReview = ref({
    rating: 5,
    title: '',
    content: ''
});

// Sample content data
const latestContent = ref([
    {
        id: 1,
        type: 'article',
        title: 'Top 10 Winter Activities in Whistler',
        source: 'Local Guide',
        date: '2023-11-15',
        excerpt: 'Discover the best winter activities that Whistler has to offer...',
        image: '/images/winter-activities.jpg'
    },
    {
        id: 2,
        type: 'news',
        title: 'New Gondola Opening December 2023',
        source: 'Mountain News',
        date: '2023-11-10',
        excerpt: 'The much anticipated new gondola will open next month...',
        image: '/images/gondola.jpg'
    }
]);

const youtubeVideos = ref([
    {
        id: 'abc123',
        title: 'Whistler Mountain Tour',
        channel: 'Travel Adventures',
        views: '125k',
        date: '2023-10-28',
        thumbnail: '/images/youtube-thumb1.jpg'
    },
    {
        id: 'def456',
        title: 'Best Restaurants in Whistler',
        channel: 'Food Explorer',
        views: '89k',
        date: '2023-11-05',
        thumbnail: '/images/youtube-thumb2.jpg'
    }
]);

const instagramPosts = ref([
    {
        id: 'insta1',
        username: '@whistlerofficial',
        caption: 'Sunrise views from the peak today! #whistler #sunrise',
        likes: '4.2k',
        date: '2023-11-12',
        image: '/images/insta1.jpg'
    },
    {
        id: 'insta2',
        username: '@mountainlover',
        caption: 'Found my new favorite trail! #hiking #whistler',
        likes: '1.8k',
        date: '2023-11-08',
        image: '/images/insta2.jpg'
    }
]);

const yelpReviews = ref([
    {
        id: 'yelp1',
        author: 'Sarah M.',
        rating: 5,
        date: '2023-11-14',
        content: 'Absolutely loved our stay! The resort was perfect and the staff were incredibly helpful.',
        business: 'Whistler Grand Hotel'
    },
    {
        id: 'yelp2',
        author: 'Michael T.',
        rating: 4,
        date: '2023-11-09',
        content: 'Great food but service was a bit slow during peak hours.',
        business: 'Peak Restaurant'
    }
]);

const tripAdvisorReviews = ref([
    {
        id: 'ta1',
        author: 'AdventureFamily',
        rating: 5,
        date: '2023-11-13',
        title: 'Perfect Family Vacation',
        content: 'We had the best time skiing and enjoying the village activities.',
        hotel: 'Whistler Mountain Resort'
    },
    {
        id: 'ta2',
        author: 'SoloTraveler22',
        rating: 4,
        date: '2023-11-07',
        title: 'Great Experience',
        content: 'Beautiful location but rooms could use some updating.',
        hotel: 'Alpine Lodge'
    }
]);

const appReviews = ref([
    {
        id: 'app1',
        author: 'John D.',
        rating: 5,
        date: '2023-11-15',
        title: 'Fantastic App',
        content: 'This app made planning our trip so easy! The trail maps were especially helpful.'
    },
    {
        id: 'app2',
        author: 'Lisa K.',
        rating: 4,
        date: '2023-11-11',
        title: 'Very Useful',
        content: 'Great for finding local restaurants, but could use more real-time updates.'
    }
]);

const submitReview = () => {
    if (newReview.value.title && newReview.value.content) {
        appReviews.value.unshift({
            id: 'new-' + Date.now(),
            author: 'You',
            rating: newReview.value.rating,
            date: new Date().toISOString().split('T')[0],
            title: newReview.value.title,
            content: newReview.value.content
        });

        // Reset form
        newReview.value = {
            rating: 5,
            title: '',
            content: ''
        };
    }
};

const currentContent = () => {
    switch (activeTab.value) {
        case 'youtube': return youtubeVideos.value;
        case 'instagram': return instagramPosts.value;
        case 'yelp': return yelpReviews.value;
        case 'tripadvisor': return tripAdvisorReviews.value;
        case 'reviews': return appReviews.value;
        default: return latestContent.value;
    }
};
</script>

<template>
    <Head :title="`${town?.name} Content & Reviews`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">
            <!-- Hero Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6 text-center text-white bg-gradient-to-r from-blue-800 to-blue-600">
                    <h1 class="text-3xl font-bold">Content & Reviews for {{ town?.name }}</h1>
                    <p class="mt-2">Discover the latest news, social content, and reviews from visitors</p>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="flex overflow-x-auto border-b border-sidebar-border/70 dark:border-sidebar-border">
                <button
                    v-for="tab in [
                        { id: 'latest', label: 'Latest Content' },
                        { id: 'youtube', label: 'YouTube' },
                        { id: 'instagram', label: 'Instagram' },
                        { id: 'yelp', label: 'Yelp' },
                        { id: 'tripadvisor', label: 'TripAdvisor' },
                        { id: 'reviews', label: 'Our Reviews' }
                    ]"
                    :key="tab.id"
                    @click="activeTab = tab.id"
                    :class="['px-4 py-3 text-sm font-medium whitespace-nowrap', activeTab === tab.id ? 'text-blue-600 border-b-2 border-blue-600' : 'text-gray-500 hover:text-gray-700']"
                >
                    {{ tab.label }}
                </button>
            </div>

            <!-- Content Section -->
            <div class="relative overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="p-6">
                    <!-- Latest Content (Articles/News) -->
                    <template v-if="activeTab === 'latest'">
                        <h2 class="mb-6 text-2xl font-bold">Latest Content</h2>
                        <div class="grid gap-6 md:grid-cols-2">
                            <div v-for="item in latestContent" :key="item.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                                <img :src="item.image" :alt="item.title" class="object-cover w-full h-48">
                                <div class="p-4">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="px-2 py-1 text-xs text-white bg-blue-600 rounded-full">{{ item.type }}</span>
                                        <span class="text-sm text-gray-500">{{ item.date }}</span>
                                    </div>
                                    <h3 class="text-xl font-semibold">{{ item.title }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">Source: {{ item.source }}</p>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300">{{ item.excerpt }}</p>
                                    <button class="w-full mt-4 btn-primary">Read More</button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- YouTube Videos -->
                    <template v-else-if="activeTab === 'youtube'">
                        <h2 class="mb-6 text-2xl font-bold">YouTube Videos</h2>
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <div v-for="video in youtubeVideos" :key="video.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                                <img :src="video.thumbnail" :alt="video.title" class="object-cover w-full h-48">
                                <div class="p-4">
                                    <h3 class="font-semibold">{{ video.title }}</h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ video.channel }}</p>
                                    <div class="flex items-center justify-between mt-2 text-sm text-gray-500">
                                        <span>{{ video.views }} views</span>
                                        <span>{{ video.date }}</span>
                                    </div>
                                    <button class="w-full mt-4 btn-primary">Watch on YouTube</button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Instagram Posts -->
                    <template v-else-if="activeTab === 'instagram'">
                        <h2 class="mb-6 text-2xl font-bold">Instagram Posts</h2>
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                            <div v-for="post in instagramPosts" :key="post.id" class="overflow-hidden border rounded-lg border-sidebar-border/30">
                                <img :src="post.image" :alt="post.caption" class="object-cover w-full h-64">
                                <div class="p-4">
                                    <div class="flex items-center justify-between">
                                        <span class="font-semibold">{{ post.username }}</span>
                                        <span class="text-sm text-gray-500">{{ post.likes }} likes</span>
                                    </div>
                                    <p class="mt-2 text-gray-600 dark:text-gray-300 line-clamp-2">{{ post.caption }}</p>
                                    <p class="mt-2 text-sm text-gray-500">{{ post.date }}</p>
                                    <button class="w-full mt-4 btn-primary">View on Instagram</button>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- Yelp Reviews -->
                    <template v-else-if="activeTab === 'yelp'">
                        <h2 class="mb-6 text-2xl font-bold">Yelp Reviews</h2>
                        <div class="space-y-6">
                            <div v-for="review in yelpReviews" :key="review.id" class="p-4 border rounded-lg border-sidebar-border/30">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="font-semibold">{{ review.author }}</h3>
                                        <p class="text-sm text-gray-500">{{ review.business }}</p>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="mr-1 font-semibold">{{ review.rating }}</span>
                                        <svg v-for="i in 5" :key="i" class="w-4 h-4" :class="i <= review.rating ? 'text-yellow-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-3 text-gray-600 dark:text-gray-300">{{ review.content }}</p>
                                <p class="mt-2 text-sm text-gray-500">{{ review.date }}</p>
                            </div>
                        </div>
                    </template>

                    <!-- TripAdvisor Reviews -->
                    <template v-else-if="activeTab === 'tripadvisor'">
                        <h2 class="mb-6 text-2xl font-bold">TripAdvisor Reviews</h2>
                        <div class="space-y-6">
                            <div v-for="review in tripAdvisorReviews" :key="review.id" class="p-4 border rounded-lg border-sidebar-border/30">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="font-semibold">{{ review.author }}</h3>
                                        <p class="text-sm text-gray-500">{{ review.hotel }}</p>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="mr-1 font-semibold">{{ review.rating }}</span>
                                        <svg v-for="i in 5" :key="i" class="w-4 h-4" :class="i <= review.rating ? 'text-green-500' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="mt-2 font-medium">{{ review.title }}</h4>
                                <p class="mt-1 text-gray-600 dark:text-gray-300">{{ review.content }}</p>
                                <p class="mt-2 text-sm text-gray-500">{{ review.date }}</p>
                            </div>
                        </div>
                    </template>

                    <!-- In-App Reviews -->
                    <template v-else-if="activeTab === 'reviews'">
                        <h2 class="mb-6 text-2xl font-bold">Visitor Reviews</h2>

                        <!-- Review Form -->
                        <div class="p-4 mb-6 border rounded-lg border-sidebar-border/30">
                            <h3 class="mb-4 text-lg font-semibold">Write a Review</h3>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-medium">Your Rating</label>
                                <div class="flex items-center">
                                    <button v-for="i in 5" :key="i" @click="newReview.rating = i" class="focus:outline-none">
                                        <svg class="w-6 h-6" :class="i <= newReview.rating ? 'text-yellow-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="review-title" class="block mb-2 text-sm font-medium">Title</label>
                                <input v-model="newReview.title" id="review-title" type="text" class="w-full p-2 border rounded border-sidebar-border/30">
                            </div>
                            <div class="mb-4">
                                <label for="review-content" class="block mb-2 text-sm font-medium">Your Review</label>
                                <textarea v-model="newReview.content" id="review-content" rows="4" class="w-full p-2 border rounded border-sidebar-border/30"></textarea>
                            </div>
                            <button @click="submitReview" class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Submit Review</button>
                        </div>

                        <!-- Reviews List -->
                        <div class="space-y-6">
                            <div v-for="review in appReviews" :key="review.id" class="p-4 border rounded-lg border-sidebar-border/30">
                                <div class="flex items-start justify-between">
                                    <h3 class="font-semibold">{{ review.author }}</h3>
                                    <div class="flex items-center">
                                        <span class="mr-1 font-semibold">{{ review.rating }}</span>
                                        <svg v-for="i in 5" :key="i" class="w-4 h-4" :class="i <= review.rating ? 'text-blue-500' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    </div>
                                </div>
                                <h4 class="mt-2 font-medium">{{ review.title }}</h4>
                                <p class="mt-1 text-gray-600 dark:text-gray-300">{{ review.content }}</p>
                                <p class="mt-2 text-sm text-gray-500">{{ review.date }}</p>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Back Links -->
            <div class="flex flex-wrap items-center gap-2 justify-evenly">
                <Link
                    :href="`/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${props.town.slug}`"
                    class="px-4 py-2 text-blue-500 transition-colors duration-200 border rounded-lg hover:bg-blue-500/10 border-sidebar-border/70 dark:border-sidebar-border"
                >
                    ← Back to {{ town?.name }}
                </Link>
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
.btn-primary {
    @apply px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
