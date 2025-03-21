<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import type { ListingType } from '@/types';
import { timeAgo } from '@/utils/forums';

const props = defineProps<{
    listing?: ListingType;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Marketplace', href: '/marketplace' },
    { title: 'Listings', href: '/marketplace/listings' },
    { title: props.listing?.category.name ?? 'Category', href: '/marketplace/listings/' + props.listing?.category.name },
    { title: props.listing?.title ?? 'Listing', href: '/marketplace/listings/' + props.listing?.id },
];
</script>

<template>
    <Head title="Listing" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="listing" class="flex flex-col gap-8 p-6 rounded-lg shadow-lg">
            <div class="grid grid-cols-1 gap-8 mt-12 md:grid-cols-2">
                
                <!-- Image Gallery -->
                <div v-if="listing.images.length > 0" class="grid grid-cols-1 gap-8">
                    <div v-for="image in listing.images" :key="image.id" class="overflow-hidden rounded-lg">
                        <img
                            :src="image.url"
                            alt="Listing Image"
                            class="object-cover w-full h-64 transition-transform duration-300 hover:scale-105"
                        />
                    </div>
                </div>

                <!-- Listing Details -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <h1 class="text-3xl font-bold text-gray-200">{{ listing.title }}</h1>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-semibold text-gray-200">${{ listing.price }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <p class="text-lg leading-relaxed text-gray-400">{{ listing.description }}</p>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-500">Category:</span>
                        <span class="text-sm text-gray-200">{{ listing.category.name }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-500">Condition:</span>
                        <span class="text-sm text-gray-200">{{ listing.condition }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-500">Seller:</span>
                        <span class="text-sm text-gray-200">{{ listing.user.name }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-500">Seller Rating:</span>
                        <span class="text-sm text-gray-200">{{ listing.seller_rating ?? 'N/A' }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-500">Item Location:</span>
                        <span class="text-sm text-gray-200">{{ listing.location ?? 'N/A' }}</span>
                    </div>

                    <div class="flex items-center gap-2">
                        <span class="text-sm font-medium text-gray-500">Listed:</span>
                        <span class="text-sm text-gray-200">{{ timeAgo(listing.created_at) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div v-else class="p-6 text-center text-gray-600 bg-white rounded-lg shadow-lg">
            <p>Listing not found.</p>
        </div>
    </AppLayout>
</template>


<!--


crud
questions
option to buy/bid/ create auction
crop images

-->
