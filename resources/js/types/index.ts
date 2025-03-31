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


export interface WeatherHourly {
    time: string;
    icon?: string;
    weather_description: string;
    temp: number;
    wind_speed: number;
    visibility: number;
}

export interface WeatherCurrent {
    sunrise: string;
    sunset: string;
    temp: number;
    feels_like: number;
    visibility: number;
    uvi: number;
    wind_speed: number;
    daily_snow: number;
    snow1: number;
}

export interface WeatherResponse {
    status?: 'success' | 'error';
    error?: string;
    data?: {
        current?: WeatherCurrent;
        hourly?: WeatherHourly[];
    };
}

export type WeatherTab = 'today' | 'tomorrow' | 'threeDays';

export interface WeatherTabItem {
    id: WeatherTab;
    label: string;
}

export interface LiftData {
    status: Record<string, string>;
    stats: {
        open: number;
        hold: number;
        scheduled: number;
        closed: number;
        percentage: Record<string, number>;
    };
    weather?: {
        date: string;
        conditions: string;
        temperature: {
            max: number;
        };
    };
    is_open: boolean;
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
