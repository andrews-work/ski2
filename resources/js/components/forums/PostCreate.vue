<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { Category } from '@/types';
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem } from '@/components/ui/dropdown-menu';

const props = defineProps<{
    categories: Category[];
    subcategories: Category[];
    errors: Record<string, string>;
}>();

const form = ref({
    title: '',
    content: '',
    category_id: null,
});

const selectedCategory = ref<Category | null>(null);
const selectedContinent = ref<Category | null>(null);
const selectedCountry = ref<Category | null>(null);
const selectedResort = ref<Category | null>(null);
const selectedNestedSubcategory = ref<Category | null>(null);

const continents = ref<Category[]>([]);
const countries = ref<Category[]>([]);
const resorts = ref<Category[]>([]);
const nestedSubcategories = ref<Category[]>([]);

const subCategoryLabel = computed(() => {
    if (selectedCategory.value?.name === 'Resorts') {
        if (selectedContinent.value) {
            if (selectedCountry.value) {
                if (selectedResort.value) {
                    return 'Select a topic';
                } else {
                    return 'Select a resort';
                }
            } else {
                return 'Select a country';
            }
        } else {
            return 'Select a continent';
        }
    } else if (selectedCategory.value?.name === 'AnotherCategory') {
        if (selectedContinent.value) {
            return 'Select a state';
        } else {
            return 'Select a region';
        }
    } else {
        return 'Select a subcategory';
    }
});

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
    selectedContinent.value = null;
    selectedCountry.value = null;
    selectedResort.value = null;
    selectedNestedSubcategory.value = null;
    countries.value = [];
    resorts.value = [];
    nestedSubcategories.value = [];
};

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
    selectedCountry.value = null;
    selectedResort.value = null;
    selectedNestedSubcategory.value = null;
    resorts.value = [];
    nestedSubcategories.value = [];
};

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
    selectedResort.value = null;
    selectedNestedSubcategory.value = null;
    nestedSubcategories.value = [];
};

const handleResortSelect = (resort: Category | null) => {
    if (resort) {
        nestedSubcategories.value = props.subcategories.filter(sub => sub.parent_id === resort.id);
        selectedResort.value = resort;
        form.value.category_id = resort.id;
    } else {
        nestedSubcategories.value = [];
        selectedResort.value = null;
        form.value.category_id = selectedCountry.value?.id || selectedContinent.value?.id || selectedCategory.value?.id || null;
    }
    selectedNestedSubcategory.value = null;
};

const handleNestedSubcategorySelect = (nestedSubcategory: Category | null) => {
    if (nestedSubcategory) {
        selectedNestedSubcategory.value = nestedSubcategory;
        form.value.category_id = nestedSubcategory.id;
    } else {
        selectedNestedSubcategory.value = null;
        form.value.category_id = selectedResort.value?.id || selectedCountry.value?.id || selectedContinent.value?.id || selectedCategory.value?.id || null;
    }
};

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
            <div>
                <Link :href="`/forums`" class="block">
                    <p class="mt-8 mb-4 text-blue-400 cursor-pointer hover:text-gray-300">Back to Forum</p>
                </Link>
            </div>
            <h1 class="mt-8 mb-4 text-xl font-extrabold text-gray-400 md:text-5xl">Create Post</h1>
            <p class="mb-[5vh] leading-relaxed text-gray-300 md:text-lg">Fill out the details below to create a new post.</p>
            <div v-if="Object.keys(errors).length > 0" class="mb-4 text-red-500">
                <ul>
                    <li v-for="(error, field) in errors" :key="field">{{ error }}</li>
                </ul>
            </div>
            <form @submit.prevent="submitForm" class="space-y-4">
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
                    <div v-if="continents.length > 0">
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ selectedContinent?.name || subCategoryLabel }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem v-for="continent in continents" :key="continent.id" @click="handleContinentSelect(continent)">
                                    {{ continent.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                    <div v-if="countries.length > 0">
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ selectedCountry?.name || subCategoryLabel }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem v-for="country in countries" :key="country.id" @click="handleCountrySelect(country)">
                                    {{ country.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                    <div v-if="resorts.length > 0">
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ selectedResort?.name || subCategoryLabel }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem v-for="resort in resorts" :key="resort.id" @click="handleResortSelect(resort)">
                                    {{ resort.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                    <div v-if="nestedSubcategories.length > 0">
                        <DropdownMenu>
                            <DropdownMenuTrigger>
                                <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    {{ selectedNestedSubcategory?.name || subCategoryLabel }}
                                </button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent>
                                <DropdownMenuItem v-for="nestedSubcategory in nestedSubcategories" :key="nestedSubcategory.id" @click="handleNestedSubcategorySelect(nestedSubcategory)">
                                    {{ nestedSubcategory.name }}
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </div>
                <div>
                    <input
                        type="text"
                        id="title"
                        v-model="form.title"
                        class="w-full px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter the post title"
                    />
                </div>
                <div>
                    <textarea
                        id="content"
                        rows="5"
                        v-model="form.content"
                        class="w-full px-4 py-2 text-white bg-transparent border rounded-lg h-[30vh] focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter the post content"
                    ></textarea>
                </div>
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
