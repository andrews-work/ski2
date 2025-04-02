<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { type Category, type Resort, type Country, type Continent } from '@/types';
import { PartyPopper, MapPinned, BriefcaseBusiness, ShoppingCart, Info, NotebookPen, Hotel, Utensils, Plane, Martini, Building2, CloudSun, Camera, Dumbbell } from 'lucide-vue-next';

const iconComponents = {
    PartyPopper,
    BriefcaseBusiness,
    ShoppingCart,
    Info,
    NotebookPen,
    Hotel,
    Martini,
    Building2,
    Utensils,
    CloudSun,
    Camera,
    Dumbbell,
    Plane,
    MapPinned
};

defineProps<{
    categories: Category[];
    continent: Continent;
    country: Country;
    resort: Resort;
}>();
</script>

<template>
    <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
        <!-- Header -->
        <div class="grid gap-4 auto-rows-min md:grid-cols-1">
            <div class="relative flex items-center justify-center h-40 overflow-hidden rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <h1 class="text-2xl font-bold text-center">Categories</h1>
            </div>
        </div>

        <!-- Category Grid -->
        <div class="grid gap-4 auto-rows-min md:grid-cols-3">
            <Link
                v-for="category in categories"
                :key="category.name"
                :href="`/resorts/${continent.slug}/${country.slug}/${resort.slug}/${category.slug}`"
                class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
            >
                <!-- Icon -->
                <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                    <component :is="iconComponents[category.icon]" class="w-12 h-12" />
                </div>

                <!-- Category Name -->
                <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    {{ category.name }}
                </h1>
            </Link>
        </div>
    </div>
</template>

