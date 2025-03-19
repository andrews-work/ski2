<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import BuyPage from '@/components/marketplace/buyPage.vue';
import SellPage from '@/components/marketplace/sellPage.vue';
import WishList from '@/components/marketplace/wishlist.vue';

const props = defineProps<{
  currentView: string;
}>();
</script>

<template>
  <Head title="Marketplace" />

  <Link
    :href="currentView === 'buy' ? '/marketplace/sell' : '/marketplace'"
    class="button"
  >
    {{ currentView === 'buy' ? 'Switch to Sell' : 'Switch to Buy' }}
  </Link>

  <Link
    :href="currentView === 'another' ? '/marketplace/buy' : '/marketplace/another'"
    class="button"
  >
    {{ currentView === 'another' ? 'Switch to Buy' : 'Switch to Another' }}
  </Link>

  <Link
    :href="currentView === 'sell' ? '/marketplace/another' : '/marketplace/sell'"
    class="button"
  >
    {{ currentView === 'sell' ? 'Switch to Another' : 'Switch to Sell' }}
  </Link>

  <Link
    :href="currentView === 'wishlist' ? '/marketplace/buy' : '/marketplace/wishlist'"
    class="button"
  >
    {{ currentView === 'wishlist' ? 'Switch to Buy' : 'Switch to WishList' }}
  </Link>

  <BuyPage v-if="currentView === 'buy'" />
  <SellPage v-else-if="currentView === 'sell'" />
  <WishList v-else-if="currentView === 'wishlist'" />
</template>
