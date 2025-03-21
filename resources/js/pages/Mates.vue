<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

import type { ListingType } from '@/types';
import Mates from '@/components/mates/mates.vue';
import Chat from '@/components/mates/chat.vue';
import Crypt from '@/components/mates/crypt.vue';
import ChatList from '@/components/mates/chatList.vue';

const props = defineProps<{
  currentView: string;
  listings?: ListingType[];
  listing?: ListingType;
}>();
</script>

<template>
    <Head title="Marketplace" />

    <!-- default -->
    <ChatList v-if="currentView === 'chatList'" />

    <!-- dynamic -->
    <Mates v-else-if="currentView === 'mates'" />
    <Chat v-else-if="currentView === 'chat'" />
    <Crypt v-else-if="currentView === 'crypt'" />

    <div v-else class="p-4 text-gray-600">
        Invalid view.
    </div>

</template>