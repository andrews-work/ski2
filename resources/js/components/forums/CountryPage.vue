<script setup lang="ts">
import { onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';
import { type Category } from '@/types';

const props = defineProps<{
    continent: Category;
    country: Category;
    resorts?: Category[];
}>();

const { resorts = [] } = props;

onMounted(() => {
    console.log('Resort list mounted - (country)');
});
</script>

<template>
    <div>
        <h2 class="mb-6 text-2xl font-bold text-center text-gray-200">{{ country.name }}</h2>
        <p class="mt-2 text-sm text-gray-200">{{ country.description }}</p>

        <div v-if="resorts && resorts.length">
            <ul class="mt-4 space-y-4">
                <li
                    v-for="resort in resorts"
                    :key="resort.id"
                    class="p-4 border border-gray-400 rounded-lg"
                >
                    <Link
                        :href="`/forums/categories/resorts/${continent.slug}/${country.slug}/${resort.slug}`"
                        class="block w-full"
                        method="get"
                    >
                        {{ resort.name }}
                    </Link>
                </li>
            </ul>
        </div>

        <div v-else class="text-center text-red-500">
            <p>Resort under construction</p>
        </div>
    </div>
</template>
