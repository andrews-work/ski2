<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
    import { usePage } from '@inertiajs/vue3';
    import AppLogoIcon from '@/components/app/AppLogoIcon.vue';

    const { auth } = usePage().props;
</script>

<template>
    <div class="flex flex-col gap-2">
        <!-- Check if auth is defined and contains a user property -->
        <div v-if="auth && auth.user">
            <Link :href="route('auths.dashboard')" class="flex items-center w-full p-2 text-sm font-medium rounded-md hover:bg-gray-700">
                <div class="flex items-center justify-start aspect-square size-8 bg-sidebar-primary text-sidebar-primary-foreground">
                    <AppLogoIcon class="text-white fill-current size-5 dark:text-black" />
                </div>
                <div class="ml-4 text-sm text-left">
                    <span class="mb-0.5 truncate font-semibold leading-none">Dashboard</span>
                </div>
            </Link>
        </div>

        <!-- If auth is not defined or doesn't have a user, show Create Account -->
        <div v-else>
            <Link :href="route('register')" class="flex items-center p-2 text-sm font-medium rounded-md hover:bg-gray-700">
                <div class="flex items-center justify-start rounded-md aspect-square size-8 bg-sidebar-primary text-sidebar-primary-foreground">
                    <AppLogoIcon class="text-white fill-current size-5 dark:text-black" />
                </div>
                <div class="ml-4 text-sm text-left">
                    <span class="mb-0.5 truncate font-semibold leading-none">Create Account</span>
                </div>
            </Link>
        </div>
    </div>
</template>
