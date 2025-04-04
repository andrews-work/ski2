<script setup lang="ts">
import { type Continent, type Country, type State, type Resort, type Category, type Town } from '@/types';
import HomePage from '@/components/resorts/homePage.vue';
import ContinentsPage from '@/components/resorts/continentsPage.vue';
import CountryPage from '@/components/resorts/countryPage.vue';
import StatePage from '@/components/resorts/statePage.vue';
import TownsPage from '@/components/resorts/townsPage.vue';
import TownPage from '@/components/resorts/townPage.vue';

const props = defineProps<{
    currentView: string;
    continents: Continent[];
    continent: Continent | null; // Only required for country/state/town views
    country: Country | null;     // Only required for state/town views
    state: State | null;         // Only required for town view
    town: Town | null;           // Only required for town view
    resorts: Resort[];
    categories: Category[];
}>();
</script>

<template>
    <HomePage v-if="currentView === 'home'" />
    <ContinentsPage v-else-if="currentView === 'continents'" :continents="continents" />
    <CountryPage
        v-else-if="currentView === 'country'"
        :continent="continent"
        :countries="countries"
        :country="country"
        :states="states"
        :towns="towns"
        :resorts="resorts"
    />
    <StatePage
        v-else-if="currentView === 'state'"
        :continent="continent"
        :country="country"
        :states="states"
        :resorts="resorts"
    />
    <TownsPage
        v-else-if="currentView === 'towns'"
        :continent="continent"
        :country="country"
        :state="state"
        :towns="towns"
    />
    <TownPage
        v-else-if="currentView === 'town'"
        :continent="continent"
        :country="country"
        :state="state"
        :towns="towns"
        :town="town"
        :resorts="resorts"
    />
</template>
