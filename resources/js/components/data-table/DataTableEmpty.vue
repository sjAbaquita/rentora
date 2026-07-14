<script setup lang="ts">
import { Database } from '@lucide/vue'
import type { Component } from 'vue';

withDefaults(
    defineProps<{
        title?: string
        description?: string
        icon?: Component
    }>(),
    {
        title: 'No records found',
        description: 'There is nothing to display yet.',
    },
)
</script>

<template>
    <div
        class="flex flex-col items-center justify-center rounded-lg border-2 border-dashed border-muted-foreground/20 bg-muted/20 px-8 py-16 text-center"
    >
        <component
            :is="icon ?? Database"
            class="mb-4 h-12 w-12 text-muted-foreground"
        />

        <h3 class="text-lg font-semibold">
            {{ title }}
        </h3>

        <p
            class="mt-2 max-w-md text-sm text-muted-foreground"
        >
            {{ description }}
        </p>

        <div
            v-if="$slots.default"
            class="mt-6"
        >
            <slot />
        </div>
    </div>
</template>