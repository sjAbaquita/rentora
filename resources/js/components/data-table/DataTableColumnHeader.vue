<script setup lang="ts">
import {
    ArrowDown,
    ArrowUp,
    ArrowUpDown,
} from "@lucide/vue"

// import type { Column } from "@tanstack/vue-table"

interface SortableColumn {
    getIsSorted(): false | 'asc' | 'desc'
    toggleSorting(desc?: boolean): void
}

const props = defineProps<{
    column: SortableColumn
    title: string
}>()

function toggleSorting() {
    props.column.toggleSorting(
        props.column.getIsSorted() === "asc"
    )
}
</script>

<template>
    <button
        class="inline-flex items-center gap-2 font-semibold hover:text-primary transition"
        @click="toggleSorting"
    >
        {{ title }}

        <ArrowUp
            v-if="column.getIsSorted() === 'asc'"
            class="h-4 w-4"
        />

        <ArrowDown
            v-else-if="column.getIsSorted() === 'desc'"
            class="h-4 w-4"
        />

        <ArrowUpDown
            v-else
            class="h-4 w-4 opacity-50"
        />
    </button>
</template>