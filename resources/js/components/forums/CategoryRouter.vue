<script setup lang="ts">
import { computed } from 'vue';
import { Category } from '@/types';

const { category, subcategories, continents, categories } = defineProps<{
    category: Category;
    subcategories: Category[];
    continents: Category[];
    categories?: Category[];
}>();

import Events from './categories/Events.vue';
import Gear from './categories/Gear.vue';
import Resorts from './categories/Resorts.vue';
import Safety from './categories/Safety.vue';
import Technique from './categories/Technique.vue';
import Other from './categories/Other.vue';

const categoryComponents = {
    'events': Events,
    'gear': Gear,
    'resorts': Resorts,
    'safety': Safety,
    'technique': Technique,
    'other': Other,
};

const categoryComponent = computed(() => {
    return categoryComponents[category.slug] || null;
});
</script>

<template>
    <div class="p-6 rounded-lg shadow-md">
        <component :is="categoryComponent" :category="category" :subcategories="subcategories" :continents="continents" :categories="categories" />
    </div>
</template>
