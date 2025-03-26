<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import Weather from '@/components/resorts/info/weather.vue';
import Geography from '@/components/resorts/info/geography.vue';

const props = defineProps<{
    currentView: string;
    continent: any;
    country: any;
    resort: any; // Resort object now includes altitude
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
    { title: 'Info' },
];
</script>

<template>
    <Head title="Info Page" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="currentView === 'info'">
            <div class="flex flex-col flex-1 h-full gap-4 p-4 rounded-xl">

                <div class="grid gap-4 auto-rows-min md:grid-cols-1">
                        <Geography :resort="resort" />
                </div>

                <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <Weather />
                    </div>
                    <div class="relative overflow-hidden border md:overflow-y-auto aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <!-- <Geography :resort="resort" /> -->
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <!-- Placeholder -->
                    </div>
                </div>

                <!-- Other grid sections -->
            </div>
        </div>
    </AppLayout>
</template>
