<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import Button from '@/components/ui/button/Button.vue';
import ReusableDropdown from '@/components/app/ReusableDropdown.vue';

const form = ref({
    title: '',
    category: null as { id: number; name: string } | null,
    description: '',
    price: '',
    condition: 'new',
    usageLevel: null as { id: string; name: string } | null,
    images: [] as File[],
});

const categories = ref([]);

onMounted(async () => {
    try {
        const response = await fetch(route('marketplace.categories'));
        categories.value = await response.json();
    } catch (error) {
        console.error('Error fetching categories:', error);
    }
});

const conditionOptions = ref([
    { id: 'new', name: 'New' },
    { id: 'used', name: 'Used' },
]);

const usageLevelOptions = ref([
    { id: 'one', name: "Used once didn't fit" },
    { id: 'two', name: 'Lightly Used' },
    { id: 'three', name: 'Heavily Used' },
    { id: 'four', name: 'thrashed' },
]);

const handleFileUpload = (event: Event) => {
    const input = event.target as HTMLInputElement;
    if (input.files) {
        form.value.images = [...form.value.images, ...Array.from(input.files)];
    }
};

const submitForm = () => {
    const formData = new FormData();

    formData.append('title', form.value.title);
    formData.append('description', form.value.description);
    formData.append('price', form.value.price);
    formData.append('condition', form.value.condition);

    if (form.value.category && form.value.category.id) {
        formData.append('category_id', form.value.category.id.toString());
    }

    if (form.value.usageLevel && form.value.usageLevel.id) {
        formData.append('usage_level', form.value.usageLevel.id);
    }

    form.value.images.forEach((image) => {
        formData.append('images[]', image);
    });

    router.post(route('marketplace.createListing'), formData, {
        onSuccess: () => {
            console.log('Item listed successfully!');
        },
        onError: (errors) => {
            console.error('Error listing item:', errors);
            if (errors && errors.errors) {
                alert('Error: ' + Object.values(errors.errors).join('\n'));
            }
        },
    });
};

</script>

<template>
    <div class="flex items-center justify-center p-8 ">
        <div class="relative flex flex-col w-full max-w-3xl p-8 shadow-lg rounded-xl">
            <h1 class="mb-8 text-3xl font-bold text-center text-gray-800 dark:text-gray-200">Create Listing</h1>
            <form @submit.prevent="submitForm" class="flex flex-col items-center justify-center space-y-6">

                <!-- Title -->
                <div class="w-full">
                    <input
                        type="text"
                        id="title"
                        v-model="form.title"
                        class="w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-background dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter title"
                        required
                    />
                </div>

                <!-- Description -->
                <div class="w-full">
                    <textarea
                        id="description"
                        v-model="form.description"
                        class="w-full h-40 px-4 py-2 text-gray-900 border border-gray-300 rounded-lg resize-none bg-background dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter description"
                        required
                    ></textarea>
                </div>

                <!-- Price -->
                <div class="w-full">
                    <input
                        type="number"
                        id="price"
                        v-model="form.price"
                        class="w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-lg bg-background dark:text-gray-200 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Enter price"
                        required
                    />
                </div>

                <!-- Condition and Usage Level -->
                <div class="flex items-center justify-center w-full gap-6">
                    <div class="flex flex-col space-y-4">
                        <div class="flex gap-6">
                            <label v-for="option in conditionOptions" :key="option.id" class="flex items-center space-x-2">
                                <input
                                    type="radio"
                                    v-model="form.condition"
                                    :value="option.id"
                                    class="w-4 h-4 text-blue-600 border-gray-700 focus:ring-blue-500"
                                />
                                <span class="text-sm text-gray-700 dark:text-gray-300">{{ option.name }}</span>
                            </label>
                        </div>
                    </div>

                    <div v-if="form.condition === 'used'" class="w-full">
                        <ReusableDropdown
                            :items="usageLevelOptions"
                            :selectedItem="form.usageLevel"
                            label="Usage level"
                            @select="(item) => (form.usageLevel = item)"
                        />
                    </div>
                </div>

                <!-- Category Dropdown -->
                <div class="w-full">
                    <ReusableDropdown
                        :items="categories"
                        :selectedItem="form.category"
                        label="Select a category"
                        @select="(item) => (form.category = item)"
                    />
                </div>

                <!-- Image Upload -->
                <div class="w-full">
                    <div class="relative">
                        <input
                            type="file"
                            id="images"
                            multiple
                            @change="handleFileUpload"
                            class="absolute inset-0 opacity-0 cursor-pointer"
                        />
                        <Button
                            variant="ghost"
                            class="px-6 py-3 border border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Upload Images
                        </Button>
                    </div>
                    <div v-if="form.images.length" class="flex flex-col mt-4 space-y-2">
                        <div v-for="(image, index) in form.images" :key="index" class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
                            <span>{{ image.name }}</span>
                            <button type="button" @click="form.images.splice(index, 1)" class="text-red-500 hover:text-red-700">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Submit Button -->
                <div class="flex justify-end w-full">
                    <Button
                        type="submit"
                        variant="outline"
                        size="default"
                        class="px-6 py-2 text-white bg-indigo-600 border rounded-lg hover:bg-lime-600 hover:border hover:border-indigo-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Create Listing
                    </Button>
                </div>

            </form>
        </div>
    </div>
</template>
