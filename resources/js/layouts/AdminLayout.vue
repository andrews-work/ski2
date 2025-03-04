<template>
    <AppLayout :sidebarItems="sidebarItems">
      <slot />
    </AppLayout>
  </template>

  <script setup lang="ts">
  import AppLayout from './AppLayout.vue';

  const sidebarItems = [
    {
      title: 'Admin Dashboard',
      href: '/admin/dashboard',
      icon: 'LayoutGrid',
    },
    {
      title: 'Manage Users',
      href: '/admin/users',
      icon: 'Users',
    },
    {
      title: 'Settings',
      href: '/admin/settings',
      icon: 'Settings',
    },
  ];
  </script>
