<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
    </Head>
    <div class="flex min-h-screen flex-col items-center bg-[#FDFDFC] p-6 text-[#1b1b18] dark:bg-[#0a0a0a] lg:justify-center lg:p-8">

        <header class="w-full">
            <nav class="flex items-center justify-between w-full max-w-screen-xl mx-auto">
                <!-- Left: Logo -->
                <div class="flex justify-start flex-1">
                    <img src="/path-to-your-logo.png" alt="Logo" class="h-10" />
                </div>

                <!-- Middle: Marketplace / Resorts / Forums -->
                <div class="flex justify-center flex-1 space-x-6">
                    <Link
                        :href="route('marketplace')"
                        class="inline-block text-sm text-[#1b1b18] dark:text-[#EDEDEC]"
                    >
                        Marketplace
                    </Link>
                    <Link
                        :href="route('resorts')"
                        class="inline-block text-sm text-[#1b1b18] dark:text-[#EDEDEC]"
                    >
                        Resorts
                    </Link>
                    <Link
                        :href="route('forums')"
                        class="inline-block text-sm text-[#1b1b18] dark:text-[#EDEDEC]"
                    >
                        Forums
                    </Link>
                </div>

                <!-- Right: Login/Register/Dashboard -->
                <div class="flex justify-end flex-1 space-x-4">
                    <template v-if="$page.props.auth.user">
                        <Link
                            :href="route('auths.dashboard')"
                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                        >
                            Dashboard
                        </Link>
                    </template>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="inline-block rounded-sm border border-transparent px-5 py-1.5 text-sm text-[#1b1b18] hover:border-[#19140035] dark:text-[#EDEDEC] dark:hover:border-[#3E3E3A]"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="route('register')"
                            class="inline-block rounded-sm border border-[#19140035] px-5 py-1.5 text-sm text-[#1b1b18] hover:border-[#1915014a] dark:border-[#3E3E3A] dark:text-[#EDEDEC] dark:hover:border-[#62605b]"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </nav>
        </header>

        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 starting:opacity-0 lg:grow">
            <main class="flex flex-col-reverse w-full max-w-full overflow-hidden rounded-lg lg:max-w-4xl lg:flex-row">
                <div>
                    <h1 class="text-red">hi</h1>
                </div>
            </main>
        </div>
        <div class="h-14.5 hidden lg:block"></div>
    </div>
</template>