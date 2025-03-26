<script setup lang="ts">
const featuredItems = [
  { id: 1, title: 'Upcoming Event: Winter Fest', description: 'Join us for the annual Winter Fest!', imageUrl: 'https://via.placeholder.com/300x400' },
  { id: 2, title: 'New Job Posting: Ski Instructor', description: 'Apply now for the ski instructor position.', imageUrl: 'https://via.placeholder.com/300x400' },
  { id: 3, title: 'Marketplace Deal: 50% Off Gear', description: 'Huge discounts on ski gear this week!', imageUrl: 'https://via.placeholder.com/300x400' },
];
</script>

<template>
  <div class="min-h-screen p-6">

    <h2 class="mb-6 text-2xl font-bold">Top Content</h2>
    <div class="flex pb-6 space-x-6 overflow-x-auto">
      <div
        v-for="item in featuredItems"
        :key="item.id"
        class="flex-none w-64 transition-all bg-gray-700 rounded-lg shadow-md hover:shadow-lg"
      >
        <img :src="item.imageUrl" alt="Post Image" class="object-cover w-full rounded-t-lg h-80" />
        <div class="p-4">
          <h3 class="text-lg font-semibold truncate">{{ item.title }}</h3>
          <p class="mt-2 text-sm text-gray-600">{{ item.description }}</p>
        </div>
      </div>
    </div>

    <h2 class="mb-6 text-2xl font-bold">Latest Content</h2>
    <div class="flex pb-6 space-x-6 overflow-x-auto">
      <div
        v-for="item in featuredItems"
        :key="item.id"
        class="flex-none w-64 transition-all bg-gray-700 rounded-lg shadow-md hover:shadow-lg"
      >
        <img :src="item.imageUrl" alt="Post Image" class="object-cover w-full rounded-t-lg h-80" />
        <div class="p-4">
          <h3 class="text-lg font-semibold truncate">{{ item.title }}</h3>
          <p class="mt-2 text-sm text-gray-600">{{ item.description }}</p>
        </div>
      </div>
    </div>

  </div>
</template>

<style scoped>
/* Optional: For a more Instagram-like feel */
img {
  border-radius: 10px;
}
</style>
