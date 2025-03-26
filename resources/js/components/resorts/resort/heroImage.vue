<script setup lang="ts">
import { onMounted } from 'vue';

const props = defineProps<{
    resort: any;
}>();

onMounted(() => {
    console.log('Resort Prop in HeroImage:', props.resort.image_url);
});
</script>

<template>
    <div
        class="h-[50vh] bg-cover bg-center"
        :style="{ backgroundImage: `url(${props.resort.image_url})` }"
    ></div>
</template>
