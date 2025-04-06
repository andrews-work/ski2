<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ref, computed } from 'vue';

// Fake data for testing
const fakeAccommodations = {
    hotels: [
        {
            id: 1,
            name: 'Fairmont Chateau Whistler',
            type: 'hotel',
            price: 350,
            rating: 4.8,
            amenities: ['hot-tub', 'restaurant', 'spa', 'shuttle'],
            rooms: 1,
            beds: 1,
            bathrooms: 1,
            image: '/images/hotels/fairmont.jpg',
            available: true,
            location: { lat: 50.1144, lng: -122.9574 }
        },
        {
            id: 2,
            name: 'Pan Pacific Whistler',
            type: 'hotel',
            price: 280,
            rating: 4.5,
            amenities: ['hot-tub', 'restaurant', 'shuttle'],
            rooms: 1,
            beds: 2,
            bathrooms: 1,
            image: '/images/hotels/pan-pacific.jpg',
            available: true,
            location: { lat: 50.1162, lng: -122.9536 }
        }
    ],
    chalets: [
        {
            id: 3,
            name: 'Luxury Mountain Chalet',
            type: 'chalet',
            price: 600,
            rating: 4.9,
            amenities: ['hot-tub', 'fireplace', 'full-kitchen', 'parking'],
            rooms: 3,
            beds: 4,
            bathrooms: 2,
            image: '/images/chalets/luxury.jpg',
            available: true,
            location: { lat: 50.1128, lng: -122.9592 }
        }
    ],
    hostels: [
        {
            id: 4,
            name: 'Whistler Lodge Hostel',
            type: 'hostel',
            price: 45,
            rating: 3.9,
            amenities: ['shared-kitchen', 'laundry', 'free-wifi'],
            rooms: 1,
            beds: 1,
            bathrooms: 0.5,
            image: '/images/hostels/lodge.jpg',
            available: true,
            location: { lat: 50.1156, lng: -122.9541 }
        }
    ],
    rent: [
        {
            id: 5,
            name: 'Mountain View Condo',
            type: 'rent',
            price: 120,
            rating: 4.2,
            amenities: ['kitchen', 'washer-dryer', 'balcony'],
            rooms: 2,
            beds: 2,
            bathrooms: 1,
            image: '/images/rent/condo.jpg',
            available: true,
            location: { lat: 50.1137, lng: -122.9563 }
        }
    ],
    buy: [
        {
            id: 6,
            name: 'Ski-in/Ski-out Chalet',
            type: 'buy',
            price: 2500000,
            rating: 0, // Not applicable for buy
            amenities: ['hot-tub', 'garage', 'mountain-view'],
            rooms: 4,
            beds: 5,
            bathrooms: 3,
            image: '/images/buy/chalet.jpg',
            available: true,
            location: { lat: 50.1119, lng: -122.9587 }
        }
    ]
};

// Fake map points data
const fakeMapPoints = [
    { id: 1, name: 'Whistler Village Gondola', type: 'chairlift', lat: 50.1153, lng: -122.9572 },
    { id: 2, name: 'Blackcomb Gondola', type: 'chairlift', lat: 50.1165, lng: -122.9543 },
    { id: 3, name: 'Merlin\'s Bar', type: 'bar', lat: 50.1158, lng: -122.9561 },
    { id: 4, name: 'Longhorn Saloon', type: 'bar', lat: 50.1149, lng: -122.9557 },
    { id: 5, name: 'Araxi Restaurant', type: 'restaurant', lat: 50.1151, lng: -122.9568 },
    { id: 6, name: 'Bearfoot Bistro', type: 'restaurant', lat: 50.1162, lng: -122.9554 },
    { id: 7, name: 'Scandinave Spa', type: 'hot-tub', lat: 50.1134, lng: -122.9581 },
    { id: 8, name: 'Fairmont Hot Tubs', type: 'hot-tub', lat: 50.1144, lng: -122.9574 }
];

const props = defineProps<{
    currentView?: string;
    continent?: any;
    country?: any;
    state?: any;
    town?: any;
    resort?: any;
    category?: any;
    accommodations?: any;
}>();

// Use fake data if props are not provided
const continent = props.continent || { name: 'North America', slug: 'north-america' };
const country = props.country || { name: 'Canada', slug: 'canada' };
const state = props.state || { name: 'British Columbia', slug: 'british-columbia' };
const town = props.town || { name: 'Whistler', slug: 'whistler' };
const category = props.category || { name: 'Accommodation', slug: 'accommodation' };
const accommodations = props.accommodations || fakeAccommodations;

// Filtering state
const selectedType = ref('all');
const selectedAmenities = ref<string[]>([]);
const priceRange = ref([0, 1000]);
const dateRange = ref({
    checkIn: new Date(),
    checkOut: new Date(Date.now() + 86400000 * 7) // 7 days from now
});
const durationType = ref('short-term'); // 'short-term' or 'long-term'
const longTermDuration = ref('month'); // 'month', 'season', 'year'
const roomRange = ref([1, 5]);
const bedRange = ref([1, 6]);
const bathroomRange = ref([1, 4]);

// Map state
const selectedMapPointType = ref('all');

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: continent.name, href: `/resorts/${continent.slug}` },
    { title: country.name, href: `/resorts/${continent.slug}/${country.slug}` },
    { title: state.name, href: `/resorts/${continent.slug}/${country.slug}/${state.slug}` },
    { title: town.name, href: `/resorts/${continent.slug}/${country.slug}/${state.slug}/${town.slug}` },
    { title: category.name, href: `/resorts/${continent.slug}/${country.slug}/${state.slug}/${town.slug}/${category.slug}` },
];

// Available amenity filters
const amenityFilters = [
    { id: 'hot-tub', label: 'Hot Tub' },
    { id: 'restaurant', label: 'Restaurant' },
    { id: 'shuttle', label: 'Shuttle Service' },
    { id: 'spa', label: 'Spa' },
    { id: 'parking', label: 'Parking' },
    { id: 'airport-transfer', label: 'Airport Transfer' }
];

// Price brackets for quick selection
const priceBrackets = [
    { label: '$0-100', min: 0, max: 100 },
    { label: '$100-200', min: 100, max: 200 },
    { label: '$200-300', min: 200, max: 300 },
    { label: '$300-400', min: 300, max: 400 },
    { label: '$400+', min: 400, max: 1000 }
];

// Category cards data
const categoryCards = [
    { type: 'chalets', label: 'Chalets', icon: '🏠', count: accommodations.chalets?.length || 0 },
    { type: 'hotels', label: 'Hotels', icon: '🏨', count: accommodations.hotels?.length || 0 },
    { type: 'hostels', label: 'Hostels', icon: '🛏️', count: accommodations.hostels?.length || 0 },
    { type: 'rent', label: 'Rent', icon: '📅', count: accommodations.rent?.length || 0 },
    { type: 'buy', label: 'Buy', icon: '💰', count: accommodations.buy?.length || 0 }
];

// Toggle amenity filter
const toggleAmenity = (amenity: string) => {
    const index = selectedAmenities.value.indexOf(amenity);
    if (index === -1) {
        selectedAmenities.value.push(amenity);
    } else {
        selectedAmenities.value.splice(index, 1);
    }
};

// Set price range from bracket
const setPriceBracket = (bracket: { min: number, max: number }) => {
    priceRange.value = [bracket.min, bracket.max];
};

// Filter map points
const filteredMapPoints = computed(() => {
    if (selectedMapPointType.value === 'all') {
        return fakeMapPoints;
    }
    return fakeMapPoints.filter(point => point.type === selectedMapPointType.value);
});

// Get filtered accommodations
const filteredAccommodations = computed(() => {
    let results = [];

    // Combine all accommodation types if 'all' is selected
    if (selectedType.value === 'all') {
        results = [
            ...(accommodations.hotels || []),
            ...(accommodations.chalets || []),
            ...(accommodations.hostels || []),
            ...(accommodations.rent || []),
            ...(accommodations.buy || [])
        ];
    } else {
        results = accommodations[selectedType.value] || [];
    }

    // Filter by amenities
    if (selectedAmenities.value.length > 0) {
        results = results.filter(acc =>
            selectedAmenities.value.every(amenity =>
                acc.amenities.includes(amenity)
            )
        );
    }

    // Filter by price range
    results = results.filter(acc =>
        acc.price >= priceRange.value[0] &&
        acc.price <= priceRange.value[1]
    );

    // Filter by rooms
    results = results.filter(acc =>
        acc.rooms >= roomRange.value[0] &&
        acc.rooms <= roomRange.value[1]
    );

    // Filter by beds
    results = results.filter(acc =>
        acc.beds >= bedRange.value[0] &&
        acc.beds <= bedRange.value[1]
    );

    // Filter by bathrooms
    results = results.filter(acc =>
        acc.bathrooms >= bathroomRange.value[0] &&
        acc.bathrooms <= bathroomRange.value[1]
    );

    return results;
});
</script>

<template>
    <Head :title="`Accommodation in ${town.name}`" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">

            <!-- Map Section -->
            <div class="p-6 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold">Location Map</h2>
                    <div class="flex gap-2">
                        <button
                            v-for="type in ['all', 'chairlift', 'bar', 'restaurant', 'hot-tub']"
                            :key="type"
                            @click="selectedMapPointType = type"
                            :class="{
                                'bg-blue-500 text-white': selectedMapPointType === type,
                                'bg-gray-100 dark:bg-gray-800': selectedMapPointType !== type
                            }"
                            class="px-3 py-1 text-sm rounded-lg"
                        >
                            {{ type === 'all' ? 'All' : type.charAt(0).toUpperCase() + type.slice(1) }}
                        </button>
                    </div>
                </div>

                <!-- Map Container (would be replaced with actual map component) -->
                <div class="relative bg-gray-100 rounded-lg h-96 dark:bg-gray-800">
                    <!-- This is a placeholder - in a real app you'd use Google Maps, Mapbox, etc. -->
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-center">
                            <div class="text-2xl">🗺️</div>
                            <p class="mt-2 text-gray-500">Interactive Map</p>
                            <p class="text-sm text-gray-400">Showing {{ filteredMapPoints.length }} points</p>
                        </div>
                    </div>

                    <!-- Map point indicators (simplified) -->
                    <div
                        v-for="point in filteredMapPoints"
                        :key="point.id"
                        class="absolute w-6 h-6 -mt-3 -ml-3 text-center map-point"
                        :style="{
                            left: `${((point.lng + 122.96) * 500)}px`,
                            top: `${((50.12 - point.lat) * 500)}px`
                        }"
                    >
                        <div class="flex items-center justify-center w-6 h-6 text-white rounded-full"
                            :class="{
                                'bg-green-500': point.type === 'chairlift',
                                'bg-blue-500': point.type === 'bar',
                                'bg-red-500': point.type === 'restaurant',
                                'bg-yellow-500': point.type === 'hot-tub'
                            }">
                            {{
                                point.type === 'chairlift' ? '⛷️' :
                                point.type === 'bar' ? '🍺' :
                                point.type === 'restaurant' ? '🍴' : '♨️'
                            }}
                        </div>
                        <div class="absolute hidden p-2 mt-1 text-xs bg-white rounded shadow-lg whitespace-nowrap dark:bg-gray-700 map-tooltip">
                            {{ point.name }}
                        </div>
                    </div>

                    <!-- Accommodation locations -->
                    <div
                        v-for="acc in filteredAccommodations"
                        :key="'acc-' + acc.id"
                        class="absolute w-4 h-4 -mt-2 -ml-2 text-center"
                        :style="{
                            left: `${((acc.location.lng + 122.96) * 500)}px`,
                            top: `${((50.12 - acc.location.lat) * 500)}px`
                        }"
                    >
                        <div class="flex items-center justify-center w-4 h-4 bg-purple-500 rounded-full">
                            <div class="w-3 h-3 bg-white rounded-full"></div>
                        </div>
                        <div class="absolute hidden p-2 mt-1 text-xs bg-white rounded shadow-lg whitespace-nowrap dark:bg-gray-700 map-tooltip">
                            {{ acc.name }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Category Cards Section -->
            <div class="grid grid-cols-2 gap-4 h-60 sm:grid-cols-3 md:grid-cols-5">
                <button
                    v-for="card in categoryCards"
                    :key="card.type"
                    @click="selectedType = card.type"
                    :class="{
                        'bg-blue-500 text-white': selectedType === card.type,
                        '': selectedType !== card.type
                    }"
                    class="flex flex-col items-center justify-center p-4 transition-all duration-200 border rounded-xl hover:shadow-lg border-sidebar-border/70 dark:border-sidebar-border"
                >
                    <span class="text-4xl">{{ card.icon }}</span>
                    <span class="mt-2 font-medium">{{ card.label }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ card.count }} options</span>
                </button>
            </div>

            <!-- Filter Section -->
            <div class="p-6 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <h2 class="mb-6 text-xl font-bold">Filter Options</h2>

                <!-- Quick Price Brackets -->
                <div class="mb-6">
                    <h3 class="mb-2 font-semibold">Price Brackets</h3>
                    <div class="flex flex-wrap gap-2">
                        <button
                            v-for="(bracket, index) in priceBrackets"
                            :key="index"
                            @click="setPriceBracket(bracket)"
                            :class="{
                                'bg-blue-500 text-white': priceRange[0] === bracket.min && priceRange[1] === bracket.max,
                                'bg-gray-100 dark:bg-gray-800': !(priceRange[0] === bracket.min && priceRange[1] === bracket.max)
                            }"
                            class="px-3 py-1 text-sm rounded-lg"
                        >
                            {{ bracket.label }}
                        </button>
                    </div>
                </div>

                <!-- Improved Range Sliders -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                    <!-- Rooms -->
                    <div>
                        <h3 class="mb-2 font-semibold">Rooms: {{ roomRange[0] }} - {{ roomRange[1] }}</h3>
                        <div class="relative pt-1">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-600 dark:text-gray-400">Min: {{ roomRange[0] }}</span>
                                <span class="text-xs text-gray-600 dark:text-gray-400">Max: {{ roomRange[1] }}</span>
                            </div>
                            <div class="relative h-8">
                                <input
                                    type="range"
                                    min="0"
                                    max="5"
                                    step="1"
                                    v-model="roomRange[0]"
                                    class="absolute w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer dark:bg-gray-600"
                                    :class="{ 'z-10': roomRange[0] > roomRange[1] - 1 }"
                                    :style="`left: 0; right: ${100 - ((roomRange[1] / 5) * 100)}%`"
                                />
                                <input
                                    type="range"
                                    min="0"
                                    max="5"
                                    step="1"
                                    v-model="roomRange[1]"
                                    class="absolute w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer dark:bg-gray-600"
                                    :style="`left: ${(roomRange[0] / 5) * 100}%; right: 0`"
                                />
                                <div
                                    class="absolute h-1 bg-blue-500 rounded-full"
                                    :style="`left: ${(roomRange[0] / 5) * 100}%; right: ${100 - ((roomRange[1] / 5) * 100)}%`"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <!-- Beds -->
                    <div>
                        <h3 class="mb-2 font-semibold">Beds: {{ bedRange[0] }} - {{ bedRange[1] }}</h3>
                        <div class="relative pt-1">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-600 dark:text-gray-400">Min: {{ bedRange[0] }}</span>
                                <span class="text-xs text-gray-600 dark:text-gray-400">Max: {{ bedRange[1] }}</span>
                            </div>
                            <div class="relative h-8">
                                <input
                                    type="range"
                                    min="1"
                                    max="6"
                                    step="1"
                                    v-model="bedRange[0]"
                                    class="absolute w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer dark:bg-gray-600"
                                    :class="{ 'z-10': bedRange[0] > bedRange[1] - 1 }"
                                    :style="`left: 0; right: ${100 - ((bedRange[1] / 6) * 100)}%`"
                                />
                                <input
                                    type="range"
                                    min="1"
                                    max="6"
                                    step="1"
                                    v-model="bedRange[1]"
                                    class="absolute w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer dark:bg-gray-600"
                                    :style="`left: ${(bedRange[0] / 6) * 100}%; right: 0`"
                                />
                                <div
                                    class="absolute h-1 bg-blue-500 rounded-full"
                                    :style="`left: ${(bedRange[0] / 6) * 100}%; right: ${100 - ((bedRange[1] / 6) * 100)}%`"
                                ></div>
                            </div>
                        </div>
                    </div>

                    <!-- Bathrooms -->
                    <div>
                        <h3 class="mb-2 font-semibold">Bathrooms: {{ bathroomRange[0] }} - {{ bathroomRange[1] }}</h3>
                        <div class="relative pt-1">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-600 dark:text-gray-400">Min: {{ bathroomRange[0] }}</span>
                                <span class="text-xs text-gray-600 dark:text-gray-400">Max: {{ bathroomRange[1] }}</span>
                            </div>
                            <div class="relative h-8">
                                <input
                                    type="range"
                                    min="1"
                                    max="4"
                                    step="0.5"
                                    v-model="bathroomRange[0]"
                                    class="absolute w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer dark:bg-gray-600"
                                    :class="{ 'z-10': bathroomRange[0] > bathroomRange[1] - 0.5 }"
                                    :style="`left: 0; right: ${100 - ((bathroomRange[1] / 4) * 100)}%`"
                                />
                                <input
                                    type="range"
                                    min="1"
                                    max="4"
                                    step="0.5"
                                    v-model="bathroomRange[1]"
                                    class="absolute w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer dark:bg-gray-600"
                                    :style="`left: ${(bathroomRange[0] / 4) * 100}%; right: 0`"
                                />
                                <div
                                    class="absolute h-1 bg-blue-500 rounded-full"
                                    :style="`left: ${(bathroomRange[0] / 4) * 100}%; right: ${100 - ((bathroomRange[1] / 4) * 100)}%`"
                                ></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Date and Duration Filters -->
                <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <h3 class="mb-2 font-semibold">Dates</h3>
                        <div class="flex gap-2">
                            <input
                                type="date"
                                v-model="dateRange.checkIn"
                                class="p-2 border rounded-lg border-sidebar-border/70 dark:border-sidebar-border"
                            >
                            <input
                                type="date"
                                v-model="dateRange.checkOut"
                                class="p-2 border rounded-lg border-sidebar-border/70 dark:border-sidebar-border"
                            >
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-2 font-semibold">Duration</h3>
                        <div class="flex gap-2">
                            <select
                                v-model="durationType"
                                class="p-2 border rounded-lg border-sidebar-border/70 dark:border-sidebar-border"
                            >
                                <option value="short-term">Short Term</option>
                                <option value="long-term">Long Term</option>
                            </select>

                            <select
                                v-if="durationType === 'long-term'"
                                v-model="longTermDuration"
                                class="p-2 border rounded-lg border-sidebar-border/70 dark:border-sidebar-border"
                            >
                                <option value="month">Month</option>
                                <option value="season">Season</option>
                                <option value="year">Year</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Improved Price Range Slider -->
                <div class="mb-6">
                    <h3 class="mb-2 font-semibold">Custom Price Range: ${{ priceRange[0] }} - ${{ priceRange[1] }}</h3>
                    <div class="relative pt-1">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600 dark:text-gray-400">Min: ${{ priceRange[0] }}</span>
                            <span class="text-xs text-gray-600 dark:text-gray-400">Max: ${{ priceRange[1] }}</span>
                        </div>
                        <div class="relative h-8">
                            <input
                                type="range"
                                min="0"
                                max="1000"
                                step="50"
                                v-model="priceRange[0]"
                                class="absolute w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer dark:bg-gray-600"
                                :class="{ 'z-10': priceRange[0] > priceRange[1] - 100 }"
                                :style="`left: 0; right: ${100 - (priceRange[1] / 1000) * 100}%`"
                            />
                            <input
                                type="range"
                                min="0"
                                max="1000"
                                step="50"
                                v-model="priceRange[1]"
                                class="absolute w-full h-1 bg-gray-300 rounded-full appearance-none cursor-pointer dark:bg-gray-600"
                                :style="`left: ${(priceRange[0] / 1000) * 100}%; right: 0`"
                            />
                            <div
                                class="absolute h-1 bg-blue-500 rounded-full"
                                :style="`left: ${(priceRange[0] / 1000) * 100}%; right: ${100 - (priceRange[1] / 1000) * 100}%`"
                            ></div>
                        </div>
                    </div>
                </div>

                <!-- Amenities -->
                <div>
                    <h3 class="mb-2 font-semibold">Amenities</h3>
                    <div class="flex flex-wrap gap-2">
                        <button
                            v-for="amenity in amenityFilters"
                            :key="amenity.id"
                            @click="toggleAmenity(amenity.id)"
                            :class="{
                                'bg-blue-500 text-white': selectedAmenities.includes(amenity.id),
                                'bg-gray-100 dark:bg-gray-800': !selectedAmenities.includes(amenity.id)
                            }"
                            class="px-3 py-1 text-sm rounded-lg"
                        >
                            {{ amenity.label }}
                        </button>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div class="p-6 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <h2 class="mb-4 text-xl font-bold">
                    {{ selectedType === 'all' ? 'All Accommodations' : `${selectedType.charAt(0).toUpperCase() + selectedType.slice(1)} in ${town.name}` }}
                    <span class="text-sm font-normal text-gray-500">({{ filteredAccommodations.length }} results)</span>
                </h2>

                <div v-if="filteredAccommodations.length === 0" class="text-center text-gray-500">
                    No accommodations found matching your filters.
                </div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    <div
                        v-for="acc in filteredAccommodations"
                        :key="acc.id"
                        class="overflow-hidden border rounded-lg border-sidebar-border/70 dark:border-sidebar-border"
                    >
                        <img :src="acc.image" :alt="acc.name" class="object-cover w-full h-48">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ acc.name }}</h3>
                            <div class="flex items-center mt-1 mb-2">
                                <span v-if="acc.rating > 0" class="text-yellow-500">★</span>
                                <span v-if="acc.rating > 0" class="ml-1">{{ acc.rating }}</span>
                                <span v-if="acc.rating > 0" class="mx-2">•</span>
                                <span class="text-sm text-gray-500">{{ acc.type }}</span>
                            </div>
                            <p class="text-lg font-bold">
                                ${{ acc.price }}
                                <span class="text-sm font-normal text-gray-500">
                                    {{ acc.type === 'buy' ? '' : '/ night' }}
                                </span>
                            </p>

                            <div class="grid grid-cols-3 gap-2 mt-3 text-sm">
                                <div class="flex items-center">
                                    <span class="mr-1">🛏️</span>
                                    <span>{{ acc.beds }} {{ acc.beds === 1 ? 'bed' : 'beds' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-1">🚪</span>
                                    <span>{{ acc.rooms }} {{ acc.rooms === 1 ? 'room' : 'rooms' }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="mr-1">🚿</span>
                                    <span>{{ acc.bathrooms }} {{ acc.bathrooms === 1 ? 'bath' : 'baths' }}</span>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-1 mt-3">
                                <span
                                    v-for="amenity in acc.amenities"
                                    :key="amenity"
                                    class="px-2 py-1 text-xs bg-gray-100 rounded dark:bg-gray-800"
                                >
                                    {{ amenityFilters.find(a => a.id === amenity)?.label || amenity }}
                                </span>
                            </div>

                            <button class="w-full px-4 py-2 mt-4 text-white bg-blue-500 rounded-lg hover:bg-blue-600">
                                {{ acc.type === 'buy' ? 'View Property' : 'Book Now' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<style>
/* Improved range slider styling */
input[type="range"] {
    -webkit-appearance: none;
    height: 4px;
    width: 100%;
    margin: 10px 0;
}

input[type="range"]:focus {
    outline: none;
}

input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    height: 18px;
    width: 18px;
    border-radius: 50%;
    background: #3b82f6;
    cursor: pointer;
    margin-top: -7px;
    position: relative;
    z-index: 10;
}

input[type="range"]::-moz-range-thumb {
    height: 18px;
    width: 18px;
    border-radius: 50%;
    background: #3b82f6;
    cursor: pointer;
    position: relative;
    z-index: 10;
}

input[type="range"]::-webkit-slider-runnable-track {
    width: 100%;
    height: 4px;
    cursor: pointer;
    background: transparent;
}

input[type="range"]::-moz-range-track {
    width: 100%;
    height: 4px;
    cursor: pointer;
    background: transparent;
}

/* Map tooltip styling */
.map-point:hover .map-tooltip {
    display: block;
}
</style>
