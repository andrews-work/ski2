<!-- Marketplace.vue -->
<script setup lang="ts">

import BuyPage from '@/components/marketplace/buyPage.vue';
import SellPage from '@/components/marketplace/sellPage.vue';
import WishList from '@/components/marketplace/wishlist.vue';
import Listing from '@/components/marketplace/listing.vue';
import ListingList from '@/components/marketplace/listingList.vue';
import MyListings from '@/components/marketplace/myListings.vue';
import CategoryListing from '@/components/marketplace/categoryListing.vue';
import type { ListingType, ListingCategory } from '@/types';

const props = defineProps<{
  currentView: string;
  listings?: ListingType[];
  listing?: ListingType;
  category?: ListingCategory;
}>();
</script>

<template>


    <!-- default -->
    <BuyPage v-if="currentView === 'buy'" />

    <!-- dynamic -->
    <SellPage v-else-if="currentView === 'sell'" />
    <WishList v-else-if="currentView === 'wishlist'" />
    <ListingList v-else-if="currentView === 'listingList'" :listings="listings" />
    <Listing v-else-if="currentView === 'listing'" :listing="listing" />
    <MyListings v-else-if="currentView === 'myListings'" :listings="listings" />

    <div v-else class="p-4 text-gray-600">
        Invalid view.
    </div>
</template>