<script setup lang="ts">
import { CableCar, LampDesk, PlugZap, Armchair, UtensilsCrossed, CarFront, Shirt, PartyPopper, House } from 'lucide-vue-next';

const categories = [
  { id: 1, name: 'Kitchen', icon: UtensilsCrossed },
  { id: 2, name: 'Car', icon: CarFront },
  { id: 3, name: 'Clothes', icon: Shirt },
  { id: 4, name: 'Ski\'s & Boards', icon: CableCar },
  { id: 5, name: 'Living Room', icon: LampDesk },
  { id: 6, name: 'Furniture', icon: Armchair },
  { id: 7, name: 'Electronics', icon: PlugZap },
  { id: 8, name: 'Events', icon: PartyPopper },
  { id: 9, name: 'Housing', icon: House },
];
</script>

<template>

<div class="flex flex-col flex-1 h-full gap-4 p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="grid gap-4 auto-rows-min md:grid-cols-1">
                    <div class="relative flex items-center justify-center overflow-hidden h-80 rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="text-2xl font-bold text-center">Categories</h1>
                    </div>
                </div>
    <div class="grid gap-4 auto-rows-min md:grid-cols-3">
      <div
        v-for="category in categories"
        :key="category.id"
        class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
      >
        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
          <component :is="category.icon" class="w-12 h-12" />
        </div>
        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
          {{ category.name }}
        </h1>
      </div>
    </div>
</div>

  </template>

