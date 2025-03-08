<script setup lang="ts">
import { ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { Category } from '@/types';
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem } from '@/components/ui/dropdown-menu';

// Define props
const props = defineProps<{
    categories: Category[];
    subcategories: Category[];
    errors: Record<string, string>; // Validation errors passed from the backend
}>();

// Form data
const form = ref({
    title: '',
    content: '',
    category_id: null,
});

// Selected category, continent, country, and resort
const selectedCategory = ref<Category | null>(null);
const selectedContinent = ref<Category | null>(null);
const selectedCountry = ref<Category | null>(null);
const selectedResort = ref<Category | null>(null);

// Filtered subcategories
const continents = ref<Category[]>([]);
const countries = ref<Category[]>([]);
const resorts = ref<Category[]>([]);

// Handle category selection (e.g., "Resorts")
const handleCategorySelect = (category: Category | null) => {
    if (category) {
        continents.value = props.subcategories.filter(sub => sub.parent_id === category.id);
        selectedCategory.value = category;
        form.value.category_id = category.id;
    } else {
        continents.value = [];
        selectedCategory.value = null;
        form.value.category_id = null;
    }
    // Reset child selections
    selectedContinent.value = null;
    selectedCountry.value = null;
    selectedResort.value = null;
    countries.value = [];
    resorts.value = [];
};

// Handle continent selection (e.g., "North America")
const handleContinentSelect = (continent: Category | null) => {
    if (continent) {
        countries.value = props.subcategories.filter(sub => sub.parent_id === continent.id);
        selectedContinent.value = continent;
        form.value.category_id = continent.id;
    } else {
        countries.value = [];
        selectedContinent.value = null;
        form.value.category_id = selectedCategory.value?.id || null;
    }
    // Reset child selections
    selectedCountry.value = null;
    selectedResort.value = null;
    resorts.value = [];
};

// Handle country selection (e.g., "USA")
const handleCountrySelect = (country: Category | null) => {
    if (country) {
        resorts.value = props.subcategories.filter(sub => sub.parent_id === country.id);
        selectedCountry.value = country;
        form.value.category_id = country.id;
    } else {
        resorts.value = [];
        selectedCountry.value = null;
        form.value.category_id = selectedContinent.value?.id || selectedCategory.value?.id || null;
    }
    // Reset child selections
    selectedResort.value = null;
};

// Handle resort selection (e.g., "Aspen")
const handleResortSelect = (resort: Category | null) => {
    if (resort) {
        selectedResort.value = resort;
        form.value.category_id = resort.id;
    } else {
        selectedResort.value = null;
        form.value.category_id = selectedCountry.value?.id || selectedContinent.value?.id || selectedCategory.value?.id || null;
    }
};

// Submit the form
const submitForm = async () => {
    try {
        await router.post('/forums/newPost', form.value);
        console.log('Post created successfully!');
    } catch (error) {
        console.error('Error creating post:', error);
    }
};
</script>

<template>
    <div class="flex items-center justify-center">
        <div class="w-full max-w-5xl p-8 text-white shadow-xl rounded-xl">
            <!-- Back to Forum Link -->
            <div>
                <Link :href="`/forums`" class="block">
                    <p class="mt-8 mb-4 text-blue-400 cursor-pointer hover:text-gray-300">Back to Forum</p>
                </Link>
            </div>

            <!-- Page Title -->
            <h1 class="mt-8 mb-4 text-xl font-extrabold text-gray-400 md:text-5xl">Create Post</h1>

            <!-- Page Description -->
            <p class="mb-[5vh] leading-relaxed text-gray-300 md:text-lg">Fill out the details below to create a new post.</p>

            <!-- Validation Errors -->
            <div v-if="Object.keys(errors).length > 0" class="mb-4 text-red-500">
                <ul>
                    <li v-for="(error, field) in errors" :key="field">{{ error }}</li>
                </ul>
            </div>

            <!-- Form -->
            <form @submit.prevent="submitForm" class="space-y-4">
                <!-- Category Selection -->
                <div class="flex items-center justify-center gap-4">
                    <div>
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ selectedCategory?.name || 'Select a category' }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem v-for="category in categories" :key="category.id" @click="handleCategorySelect(category)">
                                    {{ category.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>

                    <!-- Continent Selection -->
                    <div v-if="continents.length > 0">
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ selectedContinent?.name || 'Select a continent' }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem v-for="continent in continents" :key="continent.id" @click="handleContinentSelect(continent)">
                                    {{ continent.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>

                    <!-- Country Selection -->
                    <div v-if="countries.length > 0">
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ selectedCountry?.name || 'Select a country' }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem v-for="country in countries" :key="country.id" @click="handleCountrySelect(country)">
                                    {{ country.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>

                    <!-- Resort Selection -->
                    <div v-if="resorts.length > 0">
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ selectedResort?.name || 'Select a resort' }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem v-for="resort in resorts" :key="resort.id" @click="handleResortSelect(resort)">
                                    {{ resort.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </div>

                <!-- Title Input -->
                <div>
                    <input
                        type="text"
                        id="title"
                        v-model="form.title"
                        class="w-full px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter the post title"
                    />
                </div>

                <!-- Content Textarea -->
                <div>
                    <textarea
                        id="content"
                        rows="5"
                        v-model="form.content"
                        class="w-full px-4 py-2 text-white bg-transparent border rounded-lg h-[30vh] focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter the post content"
                    ></textarea>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-4 mt-6 space-x-4">
                    <Link :href="`/forums`" class="px-4 py-2 text-white bg-transparent border border-orange-800 rounded-lg hover:bg-orange-800">
                        Cancel
                    </Link>
                    <button
                        type="submit"
                        class="px-4 py-2 text-white bg-green-900 rounded-lg hover:bg-transparent hover:text-green-400 hover:border hover:border-green-900"
                    >
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
