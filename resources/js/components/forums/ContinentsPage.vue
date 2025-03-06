<!-- continents page - list of countries -->
<script setup lang="ts">
import { onMounted } from 'vue';
import { Category } from '@/types';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    continent: Category;
    countries: Category[];
}>();

onMounted(() => {
    console.log('Countries mounted (continents)');
});
</script>

<template>
    <div class="p-6 rounded-lg shadow-md">
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-200">{{ continent.name }}</h2>
        <p class="mt-2 text-sm text-gray-200">{{ continent.description }}</p>
        <div v-if="countries.length">
            <ul class="mt-4 space-y-4">
                <li
                    v-for="country in countries"
                    :key="country.id"
                    class="p-4 border border-gray-400 rounded-lg"
                >
                    <Link
                        :href="`/forums/categories/resorts/${continent.slug}/${country.slug}`"
                        class="block w-full"
                        method="get"
                        @click="() => console.log('Clicked country:', country)"
                    >
                        {{ country.name }}
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>
