<script setup lang="ts">
import NavFooter from './NavFooter.vue';
import NavMain from './NavMain.vue';
import NavUser from './NavUser.vue';
import NavSecond from './NavSecond.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import { BookOpen, MessageCircle, Folder, Wallpaper, NotebookPen, MountainSnow, ShoppingCart, House, UserRoundPen, HandCoins, Users, Settings, Bell, List, PersonStanding, Star, DollarSign, Wallet, Hand } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';
import { computed } from 'vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Home',
        href: '/',
        icon: House,
    },
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: Wallpaper,
    },
    {
        title: 'Forums',
        href: '/forums',
        icon: NotebookPen,
    },
    {
        title: 'Resorts',
        href: '/resorts',
        icon: MountainSnow
    },
    {
        title: 'Marketplace',
        href: '/marketplace',
        icon: ShoppingCart
    },
    {
        title: 'Casino',
        href: '/casino',
        icon: HandCoins
    },
    {
        title: 'Mates',
        href: '/mates',
        icon: Users
    }
];

const footerNavItems: NavItem[] = [
    {
        title: 'Rules?',
        href: '',
        icon: Folder,
    },
    {
        title: 'Privacy policy',
        href: '',
        icon: BookOpen,
    },
];

const secondNavItems = computed(() => {
    const route = usePage().url;

    if (route.startsWith('/forums')) {
        return [
            {
                title: 'my posts',
                href: '/forums/posts/',
                icon: UserRoundPen,
            },
            {
                title: 'my comments',
                href: '/forums/comments/',
                icon: MessageCircle,
            },
        ];
    } else if (route.startsWith('/resorts')) {
        return [
            {
                title: 'Resort List',
                href: '/resorts/list',
                icon: MountainSnow,
            },
            {
                title: 'Resort Notifications',
                href: '/resorts/notifications',
                icon: Bell,
            },
        ];
    } else if (route.startsWith('/casino')) {
        return [
            {
                title: 'Casino Games',
                href: '/casino/games',
                icon: HandCoins,
            },
            {
                title: 'Casino Leaderboard',
                href: '/casino/leaderboard',
                icon: Users,
            },
        ];
    } else if (route.startsWith('/marketplace')) {
        return [
            {
                title: 'sell',
                href: '/marketplace/sell',
                icon: HandCoins,
            },
            {
                title: 'buy',
                href: '/marketplace',
                icon: DollarSign,
            },
            {
                title: 'listings',
                href: '/marketplace/listings',
                icon: List,
            },
            {
                title: 'my listings',
                href: '/marketplace/listings/mine',
                icon: PersonStanding,
            },
            {
                title: 'purchased',
                href: '/marketplace/[urchased]',
                icon: Wallet,
            },
            {
                title: 'wishlist',
                href: '/marketplace/wishlist',
                icon: Star,
            },
        ];
    } else {
        return [];
    }
});
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <AppLogo />
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
            <div class="mt-12">
                <NavSecond :items="secondNavItems" />
            </div>
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
