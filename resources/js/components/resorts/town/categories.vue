<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { type Category, type Town, type Country, type Continent, type State } from '@/types';
import {
    PartyPopper, MapPinned, BriefcaseBusiness, ShoppingCart, Bus,
    Info, NotebookPen, Hotel, Utensils, Plane, CableCar, Brush,
    Martini, Building2, CloudSun, Camera, Dumbbell, TentTree, Axe,
    DollarSign
} from 'lucide-vue-next';

// Map icon names to components
const iconComponents: Record<string, any> = {
    'PartyPopper': PartyPopper,
    'BriefcaseBusiness': BriefcaseBusiness,
    'ShoppingCart': ShoppingCart,
    'Info': Info,
    'NotebookPen': NotebookPen,
    'Hotel': Hotel,
    'Martini': Martini,
    'Building2': Building2,
    'Utensils': Utensils,
    'CloudSun': CloudSun,
    'Camera': Camera,
    'Dumbbell': Dumbbell,
    'Plane': Plane,
    'MapPinned': MapPinned,
    'TentTree' : TentTree,
    'CableCar' : CableCar,
    'Axe' : Axe,
    'Brush' : Brush,
    'Bus' : Bus,
    'DollarSign' : DollarSign
};

const props = defineProps<{
    categories?: Category[];
    continent?: Continent | null;
    country?: Country | null;
    state?: State | null;
    town?: Town | null;
}>();

console.log('click route');

</script>

<template>
    <div class="flex flex-col flex-1 h-full gap-4 rounded-xl">
        <!-- Header -->
        <div class="grid gap-4 auto-rows-min md:grid-cols-1">
            <div class="relative flex items-center justify-center overflow-hidden h-80 rounded-xl">
                <h1 class="text-2xl font-bold text-center">Town Categories</h1>
            </div>
        </div>

        <!-- Category Grid -->
        <div v-if="categories && categories.length > 0" class="grid gap-4 auto-rows-min md:grid-cols-3">
            <Link
                v-for="category in categories"
                :key="category.id"
                :href="`/resorts/${continent?.slug}/${country?.slug}/${state?.slug}/${town?.slug}/${category.slug}`"
                class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group"
            >
                <!-- Icon -->
                <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                    <component
                        :is="iconComponents[category.icon]"
                        class="w-12 h-12"
                        v-if="iconComponents[category.icon]"
                    />
                    <span v-else>{{ category.icon }}</span>
                </div>

                <!-- Category Name -->
                <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                    {{ category.name }}
                </h1>
            </Link>
        </div>

        <div v-else class="p-8 text-center border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
            <p>No categories available for this town.</p>
        </div>
    </div>
</template>
