<script setup lang="ts">
import { ref } from 'vue';
import { Link, Head, router } from '@inertiajs/vue3'; // Import router from Inertia
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import Button from '@/components/ui/button/Button.vue';
import ReusableDropdown from '@/components/app/ReusableDropdown.vue';

// Define breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
  {
    title: 'Marketplace / Sell',
    href: '/marketplace/sell',
  },
];

// Form state
const form = ref({
  title: '',
  category: null,
  description: '',
  condition: 'new', // 'new' or 'used'
  usageLevel: null, // e.g., 'like new', 'lightly used', 'heavily used'
});

// Dropdown options
const categories = ref([
  { id: 1, name: 'Electronics' },
  { id: 2, name: 'Clothing' },
  { id: 3, name: 'Furniture' },
]);

const conditionOptions = ref([
  { id: 'new', name: 'New' },
  { id: 'used', name: 'Used' },
]);

const usageLevelOptions = ref([
  { id: 'like_new', name: 'Like New' },
  { id: 'lightly_used', name: 'Lightly Used' },
  { id: 'heavily_used', name: 'Heavily Used' },
]);

// Handle form submission
const submitForm = () => {
  router.post(route('marketplace.listItem'), form.value, {
    onSuccess: () => {
      // Handle success (e.g., show a success message or redirect)
      console.log('Item listed successfully!');
    },
    onError: (errors) => {
      // Handle errors (e.g., display validation errors)
      console.error('Error listing item:', errors);
    },
  });
};
</script>

<template>
  <Head title="Marketplace - Sell" />
  <AppLayout :breadcrumbs="breadcrumbs">
    <div class="flex flex-col gap-4 p-4 rounded-xl">
      <!-- Buy/Sell Toggle -->
      <div class="grid items-center justify-center gap-4 md:grid-cols-2">
        <Link :href="route('marketplace')" class="text-4xl" style="font-size: 80pt;">
          <div class="relative flex items-center justify-center overflow-hidden italic font-bold border h-60 rounded-xl border-sidebar-border/70 dark:border-sidebar-border hover:not-italic hover:text-lime-400">
            <h1>buy</h1>
          </div>
        </Link>
        <div class="relative flex items-center justify-center overflow-hidden italic border h-60 rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
          <h1 class="font-bold text-orange-600" style="font-size: 80pt;">sell</h1>
        </div>
      </div>

      <!-- Form Section -->
      <div class="relative flex flex-col h-auto p-4 border rounded-xl justify-evenly border-sidebar-border/70 dark:border-sidebar-border">
        <h1 class="mb-4 text-2xl font-bold">Sell Your Item</h1>

        <!-- Form -->
        <form @submit.prevent="submitForm" class="space-y-4">
          <!-- Title -->
          <div>
            <label for="title" class="block mb-2 text-sm font-medium text-gray-400">Title</label>
            <input
              type="text"
              id="title"
              v-model="form.title"
              class="w-full px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter the title of your item"
              required
            />
          </div>

          <!-- Description -->
          <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-400">Description</label>
            <input
              type="description"
              id="description"
              v-model="form.description"
              class="w-full px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter the description of your item"
              required
            />
          </div>

          <!-- Category Dropdown -->
          <div>
            <label for="category" class="block mb-2 text-sm font-medium text-gray-400">Category</label>
            <ReusableDropdown
              :items="categories"
              :selectedItem="form.category"
              label="Select a category"
              @select="(item) => (form.category = item)"
            />
          </div>

          <!-- Condition -->
          <div class="flex">
            <div class="mb-6">
              <label class="block mb-2 text-sm font-medium text-gray-400">Condition</label>
              <div class="flex gap-6">
                <label v-for="option in conditionOptions" :key="option.id" class="flex items-center">
                  <input
                    type="radio"
                    v-model="form.condition"
                    :value="option.id"
                    class="mr-3"
                  />
                  <span>{{ option.name }}</span>
                </label>
              </div>
            </div>

            <!-- Usage Level Dropdown (Conditional) -->
            <div v-if="form.condition === 'used'" class="mt-6 ml-12">
              <label for="usageLevel" class="block mb-2 text-sm font-medium text-gray-400">How Used</label>
              <ReusableDropdown
                :items="usageLevelOptions"
                :selectedItem="form.usageLevel"
                label="Select usage level"
                @select="(item) => (form.usageLevel = item)"
              />
            </div>
          </div>

          <!-- Submit Button -->
          <div class="flex justify-end">
            <button
              type="submit"
              variant="outline"
              size="default"
              class="px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700"
            >
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>