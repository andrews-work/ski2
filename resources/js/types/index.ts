import type { PageProps } from '@inertiajs/core';
import type { LucideIcon } from 'lucide-vue-next';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

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

export type BreadcrumbItemType = BreadcrumbItem;

export interface Category {
    id: number;
    name: string;
    slug: string;
    description: string;
    parent_id?: number | null;
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
