<!-- components/marketplace/categoryListing.vue -->
<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import type { ListingType, ListingCategory } from '@/types';
import { timeAgo } from '@/utils/forums';

const props = defineProps<{
    listings: ListingType[];
    category: ListingCategory;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Marketplace', href: '/marketplace' },
    { title: 'Listings', href: '/marketplace/listings' },
    { title: props.category?.name ?? 'Category', href: '/marketplace/listings/category/' + props.category?.id },
];
</script>

<template>
    <Head :title="`${category?.name} Listings`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-200">{{ category?.name }} Listings</h1>

            <div v-if="listings.length > 0" class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2 lg:grid-cols-3">
                <div v-for="listing in listings" :key="listing.id" class="p-4 bg-gray-800 rounded-lg shadow-lg">
                    <Link :href="`/marketplace/listings/${listing.id}`" class="block">
                        <div v-if="listing.images.length > 0" class="overflow-hidden rounded-lg">
                            <img
                                :src="listing.images[0].url"
                                alt="Listing Image"
                                class="object-cover w-full h-48 transition-transform duration-300 hover:scale-105"
                            />
                        </div>

                        <div class="mt-4 space-y-2">
                            <h2 class="text-xl font-semibold text-gray-200">{{ listing.title }}</h2>
                            <p class="text-lg text-gray-400">${{ listing.price }}</p>
                            <p class="text-sm text-gray-500">{{ timeAgo(listing.created_at) }}</p>
                        </div>
                    </Link>
                </div>
            </div>

            <div v-else class="mt-6 text-center text-gray-400">
                No listings found in this category.
            </div>
        </div>
    </AppLayout>
</template>