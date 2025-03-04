<template>
    <AppLayout :breadcrumbs="breadcrumbs">
      <slot />
    </AppLayout>
  </template>

  <script setup lang="ts">
  import AppLayout from './AppLayout.vue';
  import { usePage } from '@inertiajs/vue3';

  const page = usePage();
  const user = page.props.auth.user;

  const breadcrumbs = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    ...(user.role === 'moderator'
      ? [
          {
            title: 'Moderation',
            href: '/moderation',
          },
        ]
      : []),
  ];
  </script>
