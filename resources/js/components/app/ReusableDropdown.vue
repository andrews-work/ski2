<script setup lang="ts">
import { DropdownMenu, DropdownMenuTrigger, DropdownMenuContent, DropdownMenuItem } from '@/components/ui/dropdown-menu';

const props = defineProps<{
    items: any[];
    selectedItem: any;
    label: string;
}>();

const emit = defineEmits(['select']);

const handleSelect = (item: any) => {
    emit('select', item);
};
</script>

<template>
    <DropdownMenu>
        <DropdownMenuTrigger>
            <button class="px-4 py-2 text-white bg-transparent border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                {{ selectedItem?.name || label }}
            </button>
        </DropdownMenuTrigger>
        <DropdownMenuContent>
            <DropdownMenuItem v-for="item in items" :key="item.id" @click="handleSelect(item)">
                {{ item.name }}
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
