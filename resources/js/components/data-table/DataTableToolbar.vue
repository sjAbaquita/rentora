<script setup lang="ts">
import { Search } from '@lucide/vue'

import { Input } from '@/components/ui/input'

const search = defineModel<string>('search', {
    default: '',
})

const perPage = defineModel<number>('perPage', {
    default: 10,
})

withDefaults(
    defineProps<{
        placeholder?: string
        showSearch?: boolean
        showPerPage?: boolean
        perPageOptions?: number[]
    }>(),
    {
        placeholder: 'Search...',
        showSearch: true,
        showPerPage: true,
        perPageOptions: () => [10, 25, 50, 100],
    },
)
</script>

<template>
    <div
        class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between"
    >
        <!-- Left -->
        <div class="flex flex-1 items-center gap-3">
            <div
                v-if="showSearch"
                class="relative w-full max-w-sm"
            >
                <Search
                    class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground"
                />

                <Input
                    v-model="search"
                    :placeholder="placeholder"
                    class="pl-9 focus-visible:ring-2 focus-visible:ring-teal-500 focus-visible:border-teal-500"
                />
            </div>

            <slot name="filters" />
        </div>

        <!-- Right -->
        <div class="flex items-center gap-3">

			<slot name="beforeActions" />

			<select
				v-if="showPerPage"
				v-model="perPage"
				class="h-9 rounded-md border bg-background px-3 text-sm"
			>
				<option
					v-for="option in perPageOptions"
					:key="option"
					:value="option"
				>
					{{ option }}
				</option>
			</select>

			<slot name="actions" />

		</div>
    </div>
</template>