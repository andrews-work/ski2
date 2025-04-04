<script setup lang="ts">
    import { ref } from 'vue';
    import { Plus, X } from 'lucide-vue-next';
    import { Link } from '@inertiajs/vue3';
    import { type Continent, type Country, type State, type Town, type Resort } from '@/types';
    import { onMounted } from 'vue';

    onMounted(() => {
        console.log('Town:', props.town);
        console.log('Resort:', props.resort);
        if (props.town && props.resort) {
            console.log('Continent:', props.continent);
            console.log('Country:', props.country);
            console.log('State:', props.state);
        }
    });

    onMounted(() => {
    console.log('InfoBar props:', props);
    console.log('State code in InfoBar:', props.state?.code);
});

const props = defineProps<{
    continent: Continent;
    country: Country;
    state: State;
    town: Town;
    resort: Resort | null; // Resort can be null if town has no resorts
}>();

    const isExpanded = ref(false);
    const toggleExpand = () => {
        isExpanded.value = !isExpanded.value;
    };
</script>

<template>
    <div
        class="relative p-4 overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border"
        :class="isExpanded ? 'h-auto' : 'h-32'"
    >
        <!-- Main Content Grid -->
        <div class="grid gap-4 auto-rows-min md:grid-cols-8">
            <!-- First Row Items (always visible) -->
            <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
    <h1 class="text-xl">{{ state?.code ?? 'N/A' }}</h1>
    <p class="text-sm text-gray-500">state code</p>
</div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                <div class="group-hover:opacity-0">
                    <h1 class="text-xl">{{ town?.name || 'N/A' }}</h1>
                    <p class="text-sm text-gray-500">Town</p>
                </div>
                <div class="absolute inset-0 flex flex-col items-center justify-center p-4 text-white transition-all duration-300 opacity-0 bg-black/80 group-hover:opacity-100">
                    <p class="text-sm text-gray-400">10,000</p>
                </div>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border md:col-span-2">
                <Link
                    v-if="town && resort && town.slug && resort.slug && props.continent?.slug && props.country?.slug && props.state?.slug"
                    :href="`/resorts/${props.continent.slug}/${props.country.slug}/${props.state.slug}/${town.slug}/${resort.slug}`"
                    class="text-xl hover:text-blue-500 hover:underline"
                >
                {{ resort?.name || 'No Resort Found' }}
                </Link>
                <h1 v-else class="text-xl"></h1>
                <p class="text-sm text-gray-500">Resort</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border md:col-span-1">
                <h1 class="text-xl">{{ state?.timezone }}</h1>
                <p class="text-sm text-gray-500">local time</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">32cm</h1> -->
                <p class="text-sm text-gray-500">weekly snowfall</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">-3˚C</h1> -->
                <p class="text-sm text-gray-500">temp</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">15 km/h</h1> -->
                <p class="text-sm text-gray-500">Wind</p>
            </div>
        </div>

        <!-- Expanded Content (only shows when expanded) -->
        <div v-if="isExpanded" class="grid gap-4 mt-4 auto-rows-min md:grid-cols-8" style="grid-auto-rows: minmax(80px, auto)">
            <!-- First row of expanded content -->
            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">30</h1> -->
                <p class="text-sm text-gray-500">Hotels</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">12/20</h1> -->
                <p class="text-sm text-gray-500">Restaurants</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">240cm</h1> -->
                <p class="text-sm text-gray-500">Season Snow</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">120cm</h1> -->
                <p class="text-sm text-gray-500">Base Depth</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">8cm</h1> -->
                <p class="text-sm text-gray-500">Today's Snow</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">2</h1> -->
                <p class="text-sm text-gray-500">Mountains</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">blue bird</h1> -->
                <p class="text-sm text-gray-500">Conditions</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">$170</h1> -->
                <p class="text-sm text-gray-500">Ticket Price</p>
            </div>

            <!-- Second row of expanded content -->
            <div class="relative flex flex-col items-center justify-center col-span-2 row-span-2 overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="flex flex-col w-full h-full p-2">
                    <div class="flex items-center justify-center flex-1">
                        <div class="flex space-x-4">
                            <h1>blue | green | black | double black</h1>
                        </div>
                    </div>
                    <div class="flex items-center justify-center flex-1">
                        <p class="text-sm text-gray-500">Run Types</p>
                    </div>
                </div>
            </div>

            <!-- Fixed spacing between Park and Area -->
            <div class="relative flex flex-col items-center justify-center row-span-2 gap-4 p-4 overflow-hidden rounded-xl">
                <div class="flex flex-col w-full h-full gap-4">
                    <div class="flex flex-col items-center justify-center flex-1 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <!-- <h1 class="text-xl">2</h1> -->
                        <p class="text-sm text-gray-500">Park</p>
                    </div>
                    <div class="flex flex-col items-center justify-center flex-1 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <!-- <h1 class="text-xl">800acres</h1> -->
                        <p class="text-sm text-gray-500">area</p>
                    </div>
                </div>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">Everything</h1> -->
                <p class="text-sm text-gray-500">Known For</p>
            </div>
            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">13</h1> -->
                <p class="text-sm text-gray-500">bars</p>
            </div>

            <div class="relative flex flex-col items-center justify-center row-span-2 overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border md:col-span-2">
                <div class="flex flex-col justify-center h-full">
                    <div class="flex justify-center">
                        <h1 class="pr-6 text-xl">20 Chairlifts</h1>
                        <h1 class="text-xl">2 gondolas</h1>
                    </div>
                    <p class="text-sm text-center text-gray-500">Chairlifts</p>
                </div>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border md:col-span-2">
                <!-- <h1 class="text-xl">68km | 2 hours</h1> -->
                <p class="text-sm text-gray-500">Vancouver</p>
            </div>

            <div class="relative flex flex-col items-center justify-center overflow-hidden border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <!-- <h1 class="text-xl">13</h1> -->
                <p class="text-sm text-gray-500">bars</p>
            </div>
        </div>

        <!-- Expand Button with Lucide icons -->
        <button
            @click="toggleExpand"
            class="absolute p-1 text-gray-400 rounded-full right-2 top-2 hover:bg-gray-700 hover:text-white"
            :title="isExpanded ? 'Collapse' : 'Expand'"
        >
            <X v-if="isExpanded" :size="20" />
            <Plus v-else :size="20" />
        </button>
    </div>
</template>
