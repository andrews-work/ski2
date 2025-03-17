<script setup lang="ts">
import { ref, computed } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { Category } from '@/types';
import ReusableDropdown from '@/components/app/ReusableDropdown.vue';

const props = defineProps<{
    categories: Category[];
    subcategories: Category[];
    topics: Category[];
    errors?: Record<string, string>;
}>();

const errors = computed(() => props.errors || {});

const form = ref({
    title: '',
    content: '',
    category_id: null,
    topic_id: null,
});

const selectedCategory = ref<Category | null>(null);
const selectedContinent = ref<Category | null>(null);
const selectedCountry = ref<Category | null>(null);
const selectedResort = ref<Category | null>(null);
const selectedNestedSubcategory = ref<Category | null>(null);
const selectedTopic = ref<Category | null>(null);

const continents = ref<Category[]>([]);
const countries = ref<Category[]>([]);
const resorts = ref<Category[]>([]);
const nestedSubcategories = ref<Category[]>([]);
const topics = ref<Category[]>([]);

const validationError = ref<string | null>(null);

const getSubcategories = (parentId: number | null) => {
    return props.subcategories.filter(sub => sub.parent_id === parentId);
};

const handleCategorySelect = (category: Category | null) => {
    if (category) {
        continents.value = getSubcategories(category.id);
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
    selectedTopic.value = null;
    countries.value = [];
    resorts.value = [];
    nestedSubcategories.value = [];
    topics.value = [];
};

const handleContinentSelect = (continent: Category | null) => {
    if (continent) {
        countries.value = getSubcategories(continent.id);
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
    selectedTopic.value = null;
    resorts.value = [];
    nestedSubcategories.value = [];
    topics.value = [];
};

const handleCountrySelect = (country: Category | null) => {
    if (country) {
        resorts.value = getSubcategories(country.id);
        selectedCountry.value = country;
        form.value.category_id = country.id;
    } else {
        resorts.value = [];
        selectedCountry.value = null;
        form.value.category_id = selectedContinent.value?.id || selectedCategory.value?.id || null;
    }
    selectedResort.value = null;
    selectedNestedSubcategory.value = null;
    selectedTopic.value = null;
    nestedSubcategories.value = [];
    topics.value = [];
};

const handleResortSelect = (resort: Category | null) => {
    if (resort) {
        nestedSubcategories.value = getSubcategories(resort.id);
        selectedResort.value = resort;
        form.value.category_id = resort.id;
        topics.value = props.topics;
    } else {
        nestedSubcategories.value = [];
        selectedResort.value = null;
        form.value.category_id = selectedCountry.value?.id || selectedContinent.value?.id || selectedCategory.value?.id || null;
        topics.value = [];
    }
    selectedNestedSubcategory.value = null;
    selectedTopic.value = null;
};

const handleTopicSelect = (topic: Category | null) => {
    if (topic) {
        selectedTopic.value = topic;
        form.value.topic_id = topic.id;
    } else {
        selectedTopic.value = null;
        form.value.topic_id = null;
    }
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

const validateForm = () => {
    if (!selectedCategory.value) {
        validationError.value = 'Please select a category.';
        return false;
    }

    let currentCategory = selectedCategory.value;
    let currentSubcategories = getSubcategories(currentCategory.id);

    while (currentSubcategories.length > 0) {
        const selectedSubcategory = [selectedContinent.value, selectedCountry.value, selectedResort.value, selectedNestedSubcategory.value].find(
            sub => sub?.parent_id === currentCategory.id
        );

        if (!selectedSubcategory) {
            validationError.value = 'Please select all required subcategories.';
            return false;
        }

        currentCategory = selectedSubcategory;
        currentSubcategories = getSubcategories(currentCategory.id);
    }

    if (topics.value.length > 0 && !selectedTopic.value) {
        validationError.value = 'Please select a topic.';
        return false;
    }

    validationError.value = null;
    return true;
};

const submitForm = async () => {
    if (!validateForm()) {
        return;
    }

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
            <div v-if="validationError" class="mb-4 text-red-500">
                {{ validationError }}
            </div>
            <form @submit.prevent="submitForm" class="space-y-4">
                <div class="flex items-center justify-center gap-4">
                    <ReusableDropdown
                        :items="categories"
                        :selectedItem="selectedCategory"
                        label="Select a category"
                        @select="handleCategorySelect"
                    />
                    <ReusableDropdown
                        v-if="continents.length > 0"
                        :items="continents"
                        :selectedItem="selectedContinent"
                        label="Select a continent"
                        @select="handleContinentSelect"
                    />
                    <ReusableDropdown
                        v-if="countries.length > 0"
                        :items="countries"
                        :selectedItem="selectedCountry"
                        label="Select a country"
                        @select="handleCountrySelect"
                    />
                    <ReusableDropdown
                        v-if="resorts.length > 0"
                        :items="resorts"
                        :selectedItem="selectedResort"
                        label="Select a resort"
                        @select="handleResortSelect"
                    />
                    <ReusableDropdown
                        v-if="topics.length > 0"
                        :items="topics"
                        :selectedItem="selectedTopic"
                        label="Select a topic"
                        @select="handleTopicSelect"
                    />
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
                        class="px-4 py-2 text-white border border-green-900 rounded-lg hover:bg-green-900"
                    >
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
