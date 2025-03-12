<!-- resortsPage -->
<script setup lang="ts">
import { onMounted } from 'vue';
import { type Category } from '@/types';
import ResortInfo from '@/components/forums/resort/Info.vue';
import LocalEvents from '@/components/forums/resort/LocalEvents.vue';
import Hero from '@/components/forums/resort/Hero.vue';
import Mountain from '@/components/forums/resort/Mountain.vue';
import Restaurants from '@/components/forums/resort/Restaurants.vue';
import Rentals from '@/components/forums/resort/Rentals.vue';
import News from '@/components/forums/resort/News.vue';
import Party from '@/components/forums/resort/Party.vue';
import LiveChat from '@/components/forums/resort/LiveChat.vue';
import RecentComments from '@/components/forums/resort/RecentComments.vue';
import RecentPosts from '@/components/forums/resort/RecentPosts.vue';
import Travel from '@/components/forums/resort/Travel.vue';

const props = defineProps<{
    resort: Category;
    resorts: Category;
    country: Category;
}>();

onMounted(() => {
    console.log('resort mounted - (resortPage)');
    console.log('Resort:', props.resort);
    console.log('Resorts:', props.resorts);
});

</script>

<template>
    <div v-if="resort">
        <div class="flex items-center justify-center h-1/3">
            <Hero :resort="resort" :country="country"/>
        </div>

        <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">

            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <ResortInfo />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <LocalEvents />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <Mountain />
                </div>
            </div>
            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <Restaurants />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <Travel />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <Rentals />
                </div>
            </div>
            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <News />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <Party />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <h1>non skiing activities</h1>
                </div>
            </div>
            <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <LiveChat />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <RecentPosts />
                </div>
                <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70">
                    <RecentComments />
                </div>
            </div>
    </div>
</div>
    <div v-else class="text-center text-red-500">
        <p>Resort under construction or not available.</p>
    </div>
</template>
