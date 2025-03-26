<script setup lang="ts">
import ContinentsPage from '@/components/resorts/continentsPage.vue';
import CountryPage from '@/components/resorts/countryPage.vue';
import HomePage from '@/components/resorts/homePage.vue';
import ResortPage from '@/components/resorts/resortPage.vue';
import { Continent, Country, Resorts, Resort, Category } from '@/types';
import ResortsPage from '@/components/resorts/resortsPage.vue';

const props = defineProps<{
    currentView: string;
    continents: Array<Continent>;
    continent?: Continent;
    countries: Array<Country>;
    country?: Country;
    resorts?: Array<Resorts>;
    resort?: Resort;
    categories: Array<Category>;
}>();
</script>

<template>
    <HomePage v-if="currentView === 'home'" />
    <ContinentsPage v-else-if="currentView === 'continents'" :continents="continents" />
    <CountryPage v-else-if="currentView === 'country'" :continent="continent" :countries="countries"/>
    <ResortsPage v-else-if="currentView === 'resorts'" :continent="continent" :country="country" :resorts="resorts"  :categories="categories" />
    <ResortPage v-else-if="currentView === 'resort'" :continent="continent" :country="country" :resort="resort" :categories="categories" />
</template>


