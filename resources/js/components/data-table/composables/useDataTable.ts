import { router } from '@inertiajs/vue3'
import { watchDebounced } from '@vueuse/core'
import { ref } from 'vue'

interface UseDataTableOptions {
    /**
     * Inertia route URL
     * Example:
     * index.url()
     */
    url: string

    /**
     * Initial filters from Laravel
     */
    filters?: {
        search?: string
        per_page?: number
    }

    /**
     * Inertia partial reload keys
     */
    only?: string[]

    /**
     * Debounce time
     */
    debounce?: number

    /**
     * Preserve page state
     */
    preserveState?: boolean

    /**
     * Preserve scroll
     */
    preserveScroll?: boolean

    /**
     * Replace browser history
     */
    replace?: boolean
}

export function useDataTable(options: UseDataTableOptions) {
    const search = ref(options.filters?.search ?? '')

    const perPage = ref(options.filters?.per_page ?? 10)

    const loading = ref(false)

    watchDebounced(
        [search, perPage],
        ([searchValue, perPageValue]) => {
            loading.value = true

            router.get(
                options.url,
                {
                    search: searchValue,
                    per_page: perPageValue,
                    page: 1,
                },
                {
                    preserveState:
                        options.preserveState ?? true,

                    preserveScroll:
                        options.preserveScroll ?? true,

                    replace:
                        options.replace ?? true,

                    only:
                        options.only,

                    onFinish: () => {
                        loading.value = false
                    },
                },
            )
        },
        {
            debounce:
                options.debounce ?? 400,

            maxWait: 1000,
        },
    )

    return {
        search,
        perPage,
        loading,
    }
}