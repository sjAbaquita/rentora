import { computed, ref, toValue } from 'vue'
import type { MaybeRefOrGetter } from 'vue'

export function useFilters<T>(
    items: MaybeRefOrGetter<T[]>,
    searchFields: (keyof T)[]
) {
    const search = ref('')

    const filteredItems = computed(() => {
        const list = toValue(items)

        if (!search.value.trim()) {
            return list
        }

        const keyword = search.value.toLowerCase()

        return list.filter(item =>
            searchFields.some(field =>
                String(item[field] ?? '')
                    .toLowerCase()
                    .includes(keyword)
            )
        )
    })

    return {
        search,
        filteredItems,
    }
}