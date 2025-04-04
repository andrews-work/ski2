<script setup lang="ts">
import { type Continent, type Country, type State, type Resort, type Category, type Town } from '@/types';
import HomePage from '@/components/resorts/homePage.vue';
import ContinentsPage from '@/components/resorts/continentsPage.vue';
import CountryPage from '@/components/resorts/countryPage.vue';
import StatePage from '@/components/resorts/statePage.vue';
import TownsPage from '@/components/resorts/townsPage.vue';
import TownPage from '@/components/resorts/townPage.vue';
import ResortPage from '@/components/resorts/resortPage.vue';

const props = defineProps<{
    currentView: string;
    continents?: Continent[];
    continent?: Continent | null;
    countries?: Country[];
    country?: Country | null;
    states?: State[];
    state: State;
    towns?: Town[];
    town: Town;
    resorts?: Resort[];
    resort: Resort;
    categories?: Category[];
}>();
</script>

<template>
    <HomePage v-if="currentView === 'home'" />
    <ContinentsPage v-else-if="currentView === 'continents'" :continents="continents ?? []" />
    <CountryPage
        v-else-if="currentView === 'country'"
        :continent="continent ?? null"
        :countries="countries ?? []"
        :country="country ?? null"
        :states="states ?? []"
        :towns="towns ?? []"
        :resorts="resorts ?? []"
    />
    <StatePage
        v-else-if="currentView === 'state'"
        :continent="continent ?? null"
        :country="country ?? null"
        :states="states ?? []"
        :state="state"
        :resorts="resorts ?? []"
        :towns="towns ?? []"
        :town="town"
    />
    <TownsPage
        v-else-if="currentView === 'towns'"
        :continent="continent ?? null"
        :country="country ?? null"
        :state="state ?? null"
        :towns="towns ?? []"
    />
    <TownPage
        v-else-if="currentView === 'town'"
        :continent="continent ?? null"
        :country="country ?? null"
        :state="state ?? null"
        :towns="towns ?? []"
        :town="town ?? null"
        :resorts="resorts ?? []"
        :resort="resort ?? null"
        :categories="categories ?? []"
    />
    <ResortPage
        v-else-if="currentView === 'resort'"
        :continent="continent"
        :country="country"
        :resort="resort"
        :state="state"
        :town="town"
        :categories="categories ?? []"
    />
</template>



