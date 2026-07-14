<script setup lang="ts">
withDefaults(
    defineProps<{
        align?: 'left' | 'right'
        wrap?: boolean
    }>(),
    {
        align: 'right',
        wrap: true,
    },
)
</script>

<template>
    <div
        :class="[
            'flex items-center gap-2',

            wrap && 'flex-wrap',

            align === 'right'
                ? 'justify-end'
                : 'justify-start',
        ]"
    >
        <slot />
    </div>
</template>