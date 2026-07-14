<script
    setup
    lang="ts"
    generic="T extends { id: number | string }"
>
import { Loader2 } from '@lucide/vue'
import type { Component } from 'vue';
import { Button } from '@/components/ui/button'

export interface RowAction<T> {
    label: string

    icon?: Component

    variant?:
        | 'default'
        | 'secondary'
        | 'outline'
        | 'ghost'
        | 'destructive'
        | 'link'

    size?: 'default' | 'sm' | 'lg' | 'icon'

    colorClass?: string

    disabled?: boolean

    loading?: boolean

    show?: (row: T) => boolean

    onClick: (row: T) => void
}

defineProps<{
    row: T

    actions: RowAction<T>[]
}>()
</script>

<template>
    <div class="flex items-center justify-center gap-2">

        <template
            v-for="action in actions"
            :key="action.label"
        >

            <Button
                v-if="!action.show || action.show(row)"
                :variant="action.variant ?? 'ghost'"
                :size="action.size ?? 'icon'"
                :disabled="action.disabled || action.loading"
                @click="action.onClick(row)"
            >

                <Loader2
                    v-if="action.loading"
                    class="h-4 w-4 animate-spin"
                />

                <component
                    v-else-if="action.icon"
                    :is="action.icon"
                    :class="[
                        'h-4 w-4',
                        action.colorClass,
                    ]"
                />

            </Button>

        </template>

    </div>
</template>