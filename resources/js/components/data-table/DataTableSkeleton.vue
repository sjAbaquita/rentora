<script setup lang="ts">
import { computed } from 'vue'
import { Skeleton } from '@/components/ui/skeleton'

const props = withDefaults(
    defineProps<{
        rows?: number
        columns?: number
        showToolbar?: boolean
    }>(),
    {
        rows: 10,
        columns: 6,
        showToolbar: true,
    },
)

const rowArray = computed(() =>
    Array.from({ length: props.rows }, (_, i) => i),
)

const columnArray = computed(() =>
    Array.from({ length: props.columns }, (_, i) => i),
)
</script>

<template>
    <div class="space-y-4">

        <!-- Toolbar -->
        <div
            v-if="showToolbar"
            class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between"
        >
            <Skeleton class="h-9 w-full sm:w-72" />

            <div class="flex items-center gap-2">
                <Skeleton class="h-9 w-20" />
                <Skeleton class="h-9 w-32" />
            </div>
        </div>

        <!-- Table -->
        <div class="overflow-hidden rounded-lg border">
            <table class="w-full">

                <thead class="border-b bg-muted/50">
                    <tr>
                        <th
                            v-for="column in columnArray"
                            :key="column"
                            class="px-6 py-3"
                        >
                            <Skeleton class="h-4 w-20" />
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    <tr
                        v-for="row in rowArray"
                        :key="row"
                    >
                        <td
                            v-for="column in columnArray"
                            :key="column"
                            class="px-6 py-4"
                        >
                            <Skeleton class="h-4 w-full max-w-45" />
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>
</template>