<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight } from '@lucide/vue';
import type { Paginated } from '@/types/pagination';

defineProps<{
    pagination: Paginated<unknown>;
	label?: string;
}>();

const isPrevious = (label: string) => label.includes('Previous');
const isNext = (label: string) => label.includes('Next');
</script>

<template>
    <div
        v-if="pagination.last_page > 1"
        class="mt-6 flex flex-col items-center justify-between gap-4 border-t pt-4 sm:flex-row"
    >
        <p class="text-sm text-muted-foreground">
			Showing
			<span class="font-medium">{{ pagination.from }}</span>
			to
			<span class="font-medium">{{ pagination.to }}</span>
			of
			<span class="font-medium">{{ pagination.total }}</span>
			{{ label ?? 'results' }}
		</p>

        <nav
            class="flex items-center gap-1"
            aria-label="Pagination"
        >
            <template
                v-for="(link, index) in pagination.links"
                :key="index"
            >
                <!-- Disabled -->
                <span
                    v-if="!link.url"
                    class="inline-flex h-9 min-w-9 items-center justify-center rounded-md border border-sidebar-border/70 px-3 text-sm text-muted-foreground opacity-50"
                >
                    <ChevronLeft
                        v-if="isPrevious(link.label)"
                        class="h-4 w-4"
                    />

                    <ChevronRight
                        v-else-if="isNext(link.label)"
                        class="h-4 w-4"
                    />

                    <span v-else>
                        {{ link.label }}
                    </span>
                </span>

                <!-- Clickable -->
                <Link
                    v-else
                    :href="link.url"
                    preserve-scroll
                    preserve-state
                    class="inline-flex h-9 min-w-9 items-center justify-center rounded-md border border-sidebar-border/70 px-3 text-sm transition-colors"
                    :class="{
                        'border-emerald-600 bg-emerald-600 text-white':
                            link.active,
                        'hover:bg-muted': !link.active,
                    }"
                >
                    <ChevronLeft
                        v-if="isPrevious(link.label)"
                        class="h-4 w-4"
                    />

                    <ChevronRight
                        v-else-if="isNext(link.label)"
                        class="h-4 w-4"
                    />

                    <span v-else>
                        {{ link.label }}
                    </span>
                </Link>
            </template>
        </nav>
    </div>
</template>