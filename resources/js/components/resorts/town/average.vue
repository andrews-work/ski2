<script setup lang="ts">
import { ref } from 'vue';
import { ChevronLeft, ChevronRight, ChevronDown, ChevronUp } from 'lucide-vue-next';

type PriceDisplay = 'cheap' | 'average' | 'expensive' | 'no expense';

const timeFrames = [
    { id: 'day', label: 'Day' },
    { id: 'weekend', label: 'Weekend' },
    { id: 'week', label: 'Week' }
];

const priceBreakdowns = {
    day: {
        cheap: [
            { item: 'Lift Ticket', price: '$40' },
            { item: 'Bus from City', price: '$10' }
        ],
        average: [
            { item: 'Lift Ticket', price: '$80' },
            { item: 'Bus from City', price: '$10' },
            { item: 'Restaurant', price: '$20' }
        ],
        expensive: [
            { item: 'Lift Ticket', price: '$120' },
            { item: 'Private Transfer', price: '$50' },
            { item: 'Fine Dining', price: '$80' }
        ],
        'no expense': [
            { item: 'Heli Skiing', price: 'Included' },
            { item: 'Luxury Transfer', price: 'Included' },
            { item: 'Gourmet Meals', price: 'Included' }
        ]
    },
    weekend: {
        cheap: [
            { item: 'Weekend Pass', price: '$100' },
            { item: 'Bus from City', price: '$10' }
        ],
        average: [
            { item: 'Weekend Pass', price: '$150' },
            { item: 'Shuttle Service', price: '$20' },
            { item: 'Restaurant', price: '$40' }
        ],
        expensive: [
            { item: 'VIP Weekend Pass', price: '$250' },
            { item: 'Private Transfer', price: '$80' },
            { item: 'Fine Dining', price: '$120' }
        ],
        'no expense': [
            { item: 'Heli Skiing', price: 'Included' },
            { item: 'Luxury Accommodation', price: 'Included' },
            { item: 'All Meals', price: 'Included' }
        ]
    },
    week: {
        cheap: [
            { item: 'Weekly Pass', price: '$280' },
            { item: 'Bus from City', price: '$10' },
            { item: 'Self-Catering', price: '$50' }
        ],
        average: [
            { item: 'Weekly Pass', price: '$400' },
            { item: 'Shuttle Service', price: '$50' },
            { item: 'Restaurant Meals', price: '$150' }
        ],
        expensive: [
            { item: 'VIP Weekly Pass', price: '$600' },
            { item: 'Private Transfer', price: '$150' },
            { item: 'Fine Dining', price: '$300' }
        ],
        'no expense': [
            { item: 'Heli Skiing Package', price: 'Included' },
            { item: 'Luxury Chalet', price: 'Included' },
            { item: 'Personal Chef', price: 'Included' }
        ]
    }
};

const priceTotals = {
    day: {
        cheap: '$50',
        average: '$110',
        expensive: '$250',
        'no expense': 'Premium'
    },
    weekend: {
        cheap: '$110',
        average: '$210',
        expensive: '$450',
        'no expense': 'Premium'
    },
    week: {
        cheap: '$340',
        average: '$600',
        expensive: '$1050',
        'no expense': 'Premium'
    }
};

const currentDisplay = ref<Record<string, PriceDisplay>>({
    day: 'cheap',
    weekend: 'cheap',
    week: 'cheap'
});

const isExpanded = ref(true);

const cycleDisplay = (timeFrame: string, direction: 'next' | 'prev') => {
    const displays: PriceDisplay[] = ['cheap', 'average', 'expensive', 'no expense'];
    const currentIndex = displays.indexOf(currentDisplay.value[timeFrame]);

    if (direction === 'next') {
        currentDisplay.value[timeFrame] = displays[(currentIndex + 1) % displays.length];
    } else {
        currentDisplay.value[timeFrame] = displays[(currentIndex - 1 + displays.length) % displays.length];
    }
};

const toggleExpandAll = () => {
    isExpanded.value = !isExpanded.value;
};
</script>

<template>
    <div class=" rounded-xl">
        <!-- <div class="flex items-center justify-center h-40">
            <h1 class="m-4 text-xl font-semibold text-center text-gray-100">Price Breakdown</h1>
        </div> -->

        <div class="grid gap-4 md:grid-cols-3">
            <div
                v-for="timeFrame in timeFrames"
                :key="timeFrame.id"
                class="relative p-4 transition-all duration-200 border rounded-lg border-sidebar-border/70 dark:border-sidebar-border"
            >
                <h2 class="mb-4 text-lg font-medium text-center text-gray-200">{{ timeFrame.label }}</h2>

                <div class="flex items-center justify-between py-2">
                    <button
                        @click="cycleDisplay(timeFrame.id, 'prev')"
                        class="p-1 text-gray-400 rounded-full hover:bg-gray-600 hover:text-white"
                        aria-label="Previous price tier"
                    >
                        <ChevronLeft :size="20" />
                    </button>

                    <div class="flex-1 py-2 text-center">
                        <p class="text-sm text-gray-400 capitalize">{{ currentDisplay[timeFrame.id] }}</p>
                        <p class="text-2xl font-bold text-white">
                            {{ priceTotals[timeFrame.id][currentDisplay[timeFrame.id]] }}
                        </p>
                    </div>

                    <button
                        @click="cycleDisplay(timeFrame.id, 'next')"
                        class="p-1 text-gray-400 rounded-full hover:bg-gray-600 hover:text-white"
                        aria-label="Next price tier"
                    >
                        <ChevronRight :size="20" />
                    </button>
                </div>

                <!-- Price breakdown details - shows when isExpanded is true -->
                <div v-if="isExpanded" class="pt-4 mt-4 border-t border-gray-600">
                    <h3 class="mb-2 text-sm font-semibold text-gray-300">Includes:</h3>
                    <ul class="space-y-2">
                        <li
                            v-for="(item, index) in priceBreakdowns[timeFrame.id][currentDisplay[timeFrame.id]]"
                            :key="index"
                            class="flex justify-between text-sm"
                        >
                            <span class="text-gray-400">{{ item.item }}</span>
                            <span class="font-medium text-gray-200">{{ item.price }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Indicator dots -->
                <div class="absolute left-0 right-0 flex justify-center gap-1 bottom-2">
                    <span
                        v-for="display in ['cheap', 'average', 'expensive', 'no expense']"
                        :key="display"
                        class="inline-block w-2 h-2 rounded-full"
                        :class="{
                            'bg-gray-500': currentDisplay[timeFrame.id] !== display,
                            'bg-white': currentDisplay[timeFrame.id] === display
                        }"
                    />
                </div>
            </div>
        </div>

        <!-- Single expand/collapse button below cards -->
        <div class="flex justify-center mt-4">
            <button
                @click="toggleExpandAll"
                class="flex items-center gap-1 px-3 py-1 text-sm text-gray-400 rounded hover:text-white hover:bg-gray-600"
            >
                {{ isExpanded ? 'Collapse all' : 'Expand all' }}
                <component
                    :is="isExpanded ? ChevronUp : ChevronDown"
                    :size="16"
                />
            </button>
        </div>
    </div>
</template>
