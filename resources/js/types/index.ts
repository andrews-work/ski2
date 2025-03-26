import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export type BreadcrumbItemType = BreadcrumbItem;

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon;
    isActive?: boolean;
}

export interface SharedData extends PageProps {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
}

export interface Continent {
    id: number;
    name: string;
    slug: string;
}

export interface Country {
    id: number;
    name: string;
    slug: string;
    continent_id: number;
}

export interface Resort {
    id: number;
    name: string;
    slug: string;
    country_id: number;
    latitude?: number;
    longitude?: number;
    altitude?: number;
    season_start?: string;
    season_end?: string;
}


export interface Category {
    title: string;
    icon: string;
    link: string;
}







export interface ListingType {
    id: number;
    title: string;
    description: string;
    price: number;
    condition: string;
    seller_rating: string;
    location: string;
    usage_level: string | null;
    category: { id: number; name: string };
    user: { id: number; name: string };
    images: ImageType[];
    created_at: string;
}

export interface ImageType {
    id: number;
    path: string;
    url: string;
}

export interface ListingCategory {
    id: number;
    name: string;
}
export interface ForumCategory {
    id: number;
    name: string;
    slug: string;
    description: string;
    parent_id?: number | null;
    topic: {
        name: string;
        id: number;
    };
}

export interface Post {
    id: number;
    title: string;
    content: string;
    user: {
        id: number;
        name: string;
    };
    category: {
        name: string;
        slug: string;
    };
    created_at: string;
    topic: {
        name: string;
        id: number;
    };
}

export interface Comment {
    id: number;
    content: string;
    user_id: number;
    forum_post_id: number;
    created_at: string;
    updated_at: string;
    user: User;
}
