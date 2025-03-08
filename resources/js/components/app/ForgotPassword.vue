<script setup lang="ts">
import InputError from '@/components/app/InputError.vue';
import TextLink from '@/components/app/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { LoaderCircle } from 'lucide-vue-next';
import { useForm } from '@inertiajs/vue3';

const props = defineProps<{
    status?: string;
}>();

const form = useForm({
    email: '',
});

const emit = defineEmits(['submit']);

const submit = () => {
    form.post(route('password.email'));
    emit('submit');
};
</script>

<template>
    <div>
        <div v-if="status" class="mb-4 text-sm font-medium text-center text-green-600">
            {{ status }}
        </div>

        <div class="space-y-6">
            <form @submit.prevent="submit">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        autocomplete="off"
                        v-model="form.email"
                        autofocus
                        placeholder="email@example.com"
                    />
                    <InputError :message="form.errors.email" />
                </div>

                <div class="flex items-center justify-start my-6">
                    <Button class="w-full" :disabled="form.processing">
                        <LoaderCircle v-if="form.processing" class="w-4 h-4 animate-spin" />
                        Email password reset link
                    </Button>
                </div>
            </form>

            <div class="space-x-1 text-sm text-center text-muted-foreground">
                <span>Or, return to</span>
                <TextLink :href="route('login')">log in</TextLink>
            </div>
        </div>
    </div>
</template>
