<script setup lang="ts">
    import AppLayout from '@/layouts/AppLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import type { ListingType } from '@/types';
    import { type BreadcrumbItem } from '@/types';
    import { ListIcon, GridIcon } from 'lucide-vue-next';
    import { ref, onMounted, onUnmounted } from 'vue';
    import { timeAgo } from '@/utils/forums';

    const props = defineProps<{
        listings?: ListingType[];
    }>();

    const breadcrumbs: BreadcrumbItem[] = [
        { title: 'Marketplace', href: '/marketplace' },
        { title: 'Listings', href: '/marketplace/listings' },
        { title: 'My Listings', href: '/marketplace/listings/mine' },
    ];

    const viewMode = ref<'grid' | 'list'>('grid');
    const currentImageIndex = ref(0);
    const slideshowInterval = ref<number | null>(null);

    const toggleViewMode = () => {
        viewMode.value = viewMode.value === 'grid' ? 'list' : 'grid';
    };

    const startSlideshow = (listing: ListingType) => {
        if (listing.images.length > 1) {
            slideshowInterval.value = setInterval(() => {
                currentImageIndex.value = (currentImageIndex.value + 1) % listing.images.length;
            }, 1500);
        }
    };

    const stopSlideshow = () => {
        if (slideshowInterval.value) {
            clearInterval(slideshowInterval.value);
            slideshowInterval.value = null;
        }
    };

    const nextImage = (listing: ListingType) => {
        currentImageIndex.value = (currentImageIndex.value + 1) % listing.images.length;
    };

    const prevImage = (listing: ListingType) => {
        currentImageIndex.value = (currentImageIndex.value - 1 + listing.images.length) % listing.images.length;
    };

    onMounted(() => {
        // Initialize any necessary setup here
    });

    onUnmounted(() => {
        stopSlideshow();
    });
</script>

<template>
    <Head title="My Listings" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="flex p-4">
            <button
                @click="toggleViewMode"
                class="px-4 py-2 text-sm font-medium text-white border rounded-lg border-background hover:border hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
                <span v-if="viewMode === 'grid'">
                    <ListIcon class="inline-block w-5 h-5" />
                </span>
                <span v-else>
                    <GridIcon class="inline-block w-5 h-5" />
                </span>
            </button>
        </div>

        <div
            v-if="listings && listings.length > 0"
            :class="{
                'grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 p-4': viewMode === 'grid',
                'flex flex-col gap-4 p-4': viewMode === 'list',
            }"
        >
            <div
                v-for="listing in listings"
                :key="listing.id"
                :class="{
                    'p-4 border rounded-lg shadow-sm': true,
                    'w-full': viewMode === 'list',
                }"
            >
                <!-- Navigation Buttons (Outside the Link) -->
                <div class="flex items-center justify-center gap-2">
                    <!-- Previous Button -->
                    <button
                        v-if="listing.images.length > 1"
                        @mouseover="stopSlideshow"
                        @click.stop="prevImage(listing)"
                        class="p-2 text-white bg-black bg-opacity-50 rounded-full hover:bg-opacity-75"
                    >
                        &lt;
                    </button>

                    <!-- Link Wrapping the Card Content -->
                    <Link :href="route('marketplace.showListing', { listingId: listing.id })" class="flex-1">
                        <!-- Image -->
                        <div class="relative">
                            <img
                                v-if="listing.images.length > 0"
                                :src="listing.images[currentImageIndex].url"
                                alt="Listing Image"
                                :class="{
                                    'object-cover w-full h-48 rounded-lg': true,
                                    'h-64': viewMode === 'list',
                                }"
                                @mouseover="startSlideshow(listing)"
                                @mouseleave="stopSlideshow"
                            />
                        </div>

                        <!-- Card Content -->
                        <div class="p-4">
                            <h2 class="text-xl font-bold">{{ listing.title }}</h2>
                            <p class="text-gray-600">{{ listing.description }}</p>
                            <p class="text-lg font-semibold">${{ listing.price }}</p>
                            <p class="text-sm text-gray-500">{{ listing.condition }} - {{ listing.usage_level }}</p>
                            <p class="text-sm text-gray-500">Category: {{ listing.category.name }}</p>
                            <p class="text-sm text-gray-500">Seller: {{ listing.user.name }}</p>
                            <p class="text-sm text-gray-500">Listed {{ timeAgo(listing.created_at) }}</p>
                        </div>
                    </Link>

                    <!-- Next Button -->
                    <button
                        v-if="listing.images.length > 1"
                        @mouseover="stopSlideshow"
                        @click.stop="nextImage(listing)"
                        class="p-2 text-white bg-black bg-opacity-50 rounded-full hover:bg-opacity-75"
                    >
                        &gt;
                    </button>
                </div>
            </div>
        </div>

        <div v-else class="p-4 text-gray-600">
            No listings found.
        </div>
    </AppLayout>
</template>