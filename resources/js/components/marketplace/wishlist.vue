<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link } from '@inertiajs/vue3';
import { CableCar, LampDesk, PlugZap, Armchair, UtensilsCrossed, CarFront, Shirt, PartyPopper } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Marketplace ',href: '/marketplace' },
    { title: 'Wishlist',href: '/marketplace/wishlist' },

];

</script>

<template>
    <Head title="Marketplace" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4 rounded-xl">
            <h1> wishlist</h1>
            <h1>
                table: item name | price | brand | link
            </h1>
            <h1>
                edit table: add | remove items
            </h1>
            <h1>
                total cost at bottom
            </h1>
        </div>
    </AppLayout>
</template>
