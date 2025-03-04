<script setup lang="ts">
import AuthLayout from '@/Layouts/AuthLayout.vue';

defineOptions({
  layout: AuthLayout,
});
</script>

<template>
  <div>
    <h1>Dashboard</h1>
    <p>Welcome back, {{ user.name }}!</p>
  </div>
</template>

<script lang="ts">
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const user = page.props.auth.user;
</script>
