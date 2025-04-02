<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ListIcon, GridIcon } from 'lucide-vue-next';
import { ref } from 'vue';

const props = defineProps<{
    currentView: string;
    continent: any;
    country: any;
    resort: any;
    debug?: boolean;
}>();

const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Resorts', href: '/resorts' },
    { title: 'Continents', href: '/resorts/continents' },
    { title: props.continent.name, href: `/resorts/${props.continent.slug}` },
    { title: props.country.name, href: `/resorts/${props.continent.slug}/${props.country.slug}` },
    { title: props.resort.name, href: `/resorts/${props.continent.slug}/${props.country.slug}/${props.resort.slug}` },
    { title: 'Companies', href: '' },
];
</script>

<template>
    <Head title="Companies" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div v-if="currentView === 'companies'" class="p-4 text-white">
            <h1>list businesses<br>

                categories - physios, law, it, contsutrction, etc.. <br>

                create business button<br>


                component - create form - address / phone number / email (optional - can just use in chat messaging)<br>

                advertise jobs - <br>

                do you want to create a 'store' on the marketplace?<br>
                do you wnat to purchase adds? <br>



            </h1>

        </div>
    </AppLayout>
</template>
