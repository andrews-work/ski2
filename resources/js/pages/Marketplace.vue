<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { CableCar, LampDesk, PlugZap, Armchair, UtensilsCrossed, CarFront, Shirt, PartyPopper } from 'lucide-vue-next';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Marketplace',
        href: '/marketplace',
    },
];
</script>

<template>
    <Head title="Marketplace" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4 rounded-xl">

            <!-- not responsive size -->
            <div class="grid items-center justify-center gap-4 md:grid-cols-2">
                <div class="relative flex items-center justify-center overflow-hidden italic font-bold border h-60 rounded-xl border-sidebar-border/70 dark:border-sidebar-border text-lime-400 hover:not-italic">
                    <h1 class="text-4xl" style="font-size: 80pt;">buy</h1>
                </div>
                <div class="relative flex items-center justify-center overflow-hidden italic border h-60 rounded-xl border-sidebar-border/70 dark:border-sidebar-border hover:not-italic">
                    <h1 class="font-bold text-orange-600 " style="font-size: 80pt;">sell</h1>
                </div>
            </div>

            <!-- not responsive size -->
            <div class="relative flex items-center h-20 p-4 border rounded-xl justify-evenly border-sidebar-border/70 dark:border-sidebar-border">
                <h1>hello</h1>
                <h1>search</h1>
                <h1>category select</h1>
                <h1>sort by dropdown</h1>
                <h1>sponsored listings</h1>
                <h1>auth history</h1>
                <h1>auth wishlist</h1>
            </div>

            <div class="flex flex-col flex-1 h-full gap-4 p-4 border rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                <div class="grid gap-4 auto-rows-min md:grid-cols-1">
                    <div class="relative flex items-center justify-center overflow-hidden h-80 rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
                        <h1 class="text-2xl font-bold text-center">categories</h1>
                    </div>
                </div>

                <div class="grid gap-4 auto-rows-min md:grid-cols-3">
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                            <UtensilsCrossed class="w-12 h-12" />
                        </div>
                        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            Kitchen
                        </h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                            <CarFront class="w-12 h-12" />
                        </div>
                        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            Car
                        </h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                            <Shirt class="w-12 h-12" />
                        </div>
                        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            Clothes
                        </h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                            <CableCar class="w-12 h-12" />
                        </div>
                        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            Ski's & Boards
                        </h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                            <LampDesk class="w-12 h-12" />
                        </div>
                        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            Living Room
                        </h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                            <Armchair class="w-12 h-12" />
                        </div>
                        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            Furniture
                        </h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                            <PlugZap class="w-12 h-12" />
                        </div>
                        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            Electronics
                        </h1>
                    </div>
                    <div class="relative overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border group">
                        <div class="absolute inset-0 flex items-center justify-center transition-opacity duration-300 group-hover:opacity-0">
                            <PartyPopper class="w-12 h-12" />
                        </div>
                        <h1 class="absolute inset-0 flex items-center justify-center text-2xl font-bold text-center transition-opacity duration-300 opacity-0 group-hover:opacity-100">
                            Events
                        </h1>
                    </div>
                </div>
            </div>

            <div class="flex flex-col flex-1 gap-4 rounded-xl">
    <div class="grid gap-4 auto-rows-min md:grid-cols-1">
        <div class="relative flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
            <div class="p-6 overflow-y-auto rounded-lg shadow-md">
                <h2 class="h-40 mb-6 text-2xl font-bold text-center text-gray-400">Recent Posts</h2>
                <ul class="space-y-4 ">
                    <!-- Example Post 1 -->
                    <li class="p-6 transition-shadow duration-200 border border-gray-700 rounded-lg hover:border-gray-400 hover:shadow-lg">
                        <a href="/forums/posts/1" class="block">
                            <h1 class="text-xl font-semibold text-gray-400 truncate">How to Learn JavaScript in 30 Days</h1>
                            <p class="max-w-full mt-2 text-base text-gray-200 truncate whitespace-nowrap">
                                This post discusses a structured approach to mastering JavaScript over the course of 30 days, with daily tasks and tips.
                            </p>
                            <div class="flex items-center justify-between mt-4 space-x-4">
                                <a href="/forums/posts/users/1" class="block">
                                    <p class="text-sm text-gray-400 hover:text-orange-300">John Doe</p>
                                </a>
                                <p class="text-xs text-gray-500">2 hours ago</p>
                                <a href="/forums/categories/web-development" class="block">
                                    <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">Web Development</p>
                                </a>
                            </div>
                        </a>
                    </li>

                    <!-- Example Post 2 -->
                    <li class="p-6 transition-shadow duration-200 border border-gray-700 rounded-lg hover:border-gray-400 hover:shadow-lg">
                        <a href="/forums/posts/2" class="block">
                            <h1 class="text-xl font-semibold text-gray-400 truncate">Best Practices for Responsive Design</h1>
                            <p class="max-w-full mt-2 text-base text-gray-200 truncate whitespace-nowrap">
                                Learn the essential best practices for creating responsive websites that work well on all devices and screen sizes.
                            </p>
                            <div class="flex items-center justify-between mt-4 space-x-4">
                                <a href="/forums/posts/users/2" class="block">
                                    <p class="text-sm text-gray-400 hover:text-orange-300">Jane Smith</p>
                                </a>
                                <p class="text-xs text-gray-500">4 hours ago</p>
                                <a href="/forums/categories/design" class="block">
                                    <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">Design</p>
                                </a>
                            </div>
                        </a>
                    </li>

                    <!-- Example Post 3 -->
                    <li class="p-6 transition-shadow duration-200 border border-gray-700 rounded-lg hover:border-gray-400 hover:shadow-lg">
                        <a href="/forums/posts/3" class="block">
                            <h1 class="text-xl font-semibold text-gray-400 truncate">CSS Grid vs Flexbox: Which One to Use?</h1>
                            <p class="max-w-full mt-2 text-base text-gray-200 truncate whitespace-nowrap">
                                A detailed comparison of CSS Grid and Flexbox to help you decide which layout technique is best for your projects.
                            </p>
                            <div class="flex items-center justify-between mt-4 space-x-4">
                                <a href="/forums/posts/users/3" class="block">
                                    <p class="text-sm text-gray-400 hover:text-orange-300">Michael Lee</p>
                                </a>
                                <p class="text-xs text-gray-500">1 day ago</p>
                                <a href="/forums/categories/css" class="block">
                                    <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">CSS</p>
                                </a>
                            </div>
                        </a>
                    </li>

                    <!-- Example Post 4 -->
                    <li class="p-6 transition-shadow duration-200 border border-gray-700 rounded-lg hover:border-gray-400 hover:shadow-lg">
                        <a href="/forums/posts/4" class="block">
                            <h1 class="text-xl font-semibold text-gray-400 truncate">A Guide to SEO for Beginners</h1>
                            <p class="max-w-full mt-2 text-base text-gray-200 truncate whitespace-nowrap">
                                Discover the basics of Search Engine Optimization (SEO) and how you can start improving your website's visibility.
                            </p>
                            <div class="flex items-center justify-between mt-4 space-x-4">
                                <a href="/forums/posts/users/4" class="block">
                                    <p class="text-sm text-gray-400 hover:text-orange-300">Sarah Taylor</p>
                                </a>
                                <p class="text-xs text-gray-500">3 days ago</p>
                                <a href="/forums/categories/seo" class="block">
                                    <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">SEO</p>
                                </a>
                            </div>
                        </a>
                    </li>

                    <!-- Example Post 5 -->
                    <li class="p-6 transition-shadow duration-200 border border-gray-700 rounded-lg hover:border-gray-400 hover:shadow-lg">
                        <a href="/forums/posts/5" class="block">
                            <h1 class="text-xl font-semibold text-gray-400 truncate">Understanding Async Programming in JavaScript</h1>
                            <p class="max-w-full mt-2 text-base text-gray-200 truncate whitespace-nowrap">
                                Dive into the world of asynchronous programming in JavaScript and learn how to handle promises and async/await.
                            </p>
                            <div class="flex items-center justify-between mt-4 space-x-4">
                                <a href="/forums/posts/users/5" class="block">
                                    <p class="text-sm text-gray-400 hover:text-orange-300">David Chen</p>
                                </a>
                                <p class="text-xs text-gray-500">1 week ago</p>
                                <a href="/forums/categories/javascript" class="block">
                                    <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">JavaScript</p>
                                </a>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


        </div>
    </AppLayout>
</template>


<!-- components -->

<!--
- history
- sell
- categories list
- category page

-->


<!-- pages -->
<!--

- marketplace
- pay form (if guest, ask if they want to create an account with email)
-->



<!-- needs -->
<!--

- sell button

- categories
    - skis
    - snowboards
    - boots
    - jackets
    - pants
    - goggles
    - hoodies
    - poles
    - backpacks
    - avi gear
- shopping cart modal
- view cart (login to buy)
- pay form - multistep
    - address
    - pay
    - confirm
        - email invoice
- if logged in, show history
    - wishlist
    - ordered
    - complete orders



-->

