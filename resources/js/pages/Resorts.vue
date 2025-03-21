<!--

slowly start building it up: create route:
    - default
    - continents
    - country
    - resorts
    - area

    - resortPage: route - /resorts/continent/country/area/resort

-->



<script setup lang="ts">
import ContinentsPage from '@/components/resorts/continentsPage.vue';
import CountryPage from '@/components/resorts/countryPage.vue';
import HomePage from '@/components/resorts/homePage.vue';
import ResortListPage from '@/components/resorts/resortListPage.vue';


const props = defineProps<{
  currentView: string;
}>();


</script>

<template>

<!-- default -->
<HomePage v-if="currentView === 'home'" />

<ContinentsPage v-else-if="currentView === 'continents'" />
<CountryPage v-else-if="currentView === 'country'" />
<ResortListPage v-else-if="currentView === 'resortList'" />

</template>

<!-- needs

way to select resort
resort page


-->



<!-- resort info

weather
location
distnace from nearest major city
run info
chairlift info


-->
