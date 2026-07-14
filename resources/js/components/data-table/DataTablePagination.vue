<script setup lang="ts">
import Pagination from '@/components/Pagination.vue'
import type { Paginated } from '@/types/pagination'

defineProps<{
    pagination: Paginated<unknown>

    label?: string

    showSummary?: boolean
}>()
</script>

<template>
    <div
        class="mt-2 flex flex-col gap-4 border-t pt-2 sm:flex-row sm:items-center sm:justify-between"
    >
        <div
            v-if="showSummary !== false"
            class="text-sm text-muted-foreground"
        >
            Showing
            <span class="font-medium">
                {{ pagination.from ?? 0 }}
            </span>
            to
            <span class="font-medium">
                {{ pagination.to ?? 0 }}
            </span>
            of
            <span class="font-medium">
                {{ pagination.total }}
            </span>
            {{ label ?? 'records' }}
        </div>

        <Pagination
            :pagination="pagination"
            :label="label"
        />
    </div>
</template>