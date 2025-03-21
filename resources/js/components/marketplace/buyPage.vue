<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import SearchBar from '@/components/marketplace/searchBar.vue';
import CategoryList from '@/components/marketplace/categoryList.vue';
import SponsoredListings from '@/components/marketplace/sponsoredListings.vue';

const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Marketplace',
    href: '/marketplace',
  },
];
</script>

<template>
  <Head title="Marketplace" />

  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-4 p-4 rounded-xl">

      <div class="grid items-center justify-center gap-4 md:grid-cols-2">
        <div class="relative flex items-center justify-center overflow-hidden italic font-bold border h-60 rounded-xl border-sidebar-border/70 dark:border-sidebar-border text-lime-400 hover:text-lime-500">
          <h1 class="text-4xl" style="font-size: 80pt;">buy</h1>
        </div>

        <Link :href="route('marketplace.sell')" class="font-bold text-white hover:text-orange-500" style="font-size: 80pt;">
          <div class="relative flex items-center justify-center overflow-hidden italic border h-60 rounded-xl border-sidebar-border/70 dark:border-sidebar-border hover:not-italic">
            <h1>sell</h1>
          </div>
        </Link>
      </div>

      <SearchBar />
      <CategoryList />
      <SponsoredListings />
    </div>
  </AppLayout>
</template>