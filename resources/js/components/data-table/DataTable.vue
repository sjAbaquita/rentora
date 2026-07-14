<script
    setup
    lang="ts"
    generic="TData, TValue"
>
import {
    FlexRender,
    getCoreRowModel,
    getSortedRowModel,
    useVueTable
} from "@tanstack/vue-table"
import type { ColumnDef, SortingState, ColumnFiltersState, VisibilityState, RowSelectionState } from '@tanstack/vue-table'

import {
    ref,
    watch,
} from "vue"

import DataTableEmpty from "./DataTableEmpty.vue"
import DataTableSkeleton from "./DataTableSkeleton.vue"

import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/components/ui/table"

const props = withDefaults(
    defineProps<{
        columns: ColumnDef<TData, TValue>[]
        data: TData[]
        loading?: boolean
        emptyTitle?: string
        emptyDescription?: string
    }>(),
    {
        loading: false,
        emptyTitle: "No records found",
        emptyDescription: "There is nothing to display.",
    },
)

const sorting = ref<SortingState>([])

const columnFilters = ref<ColumnFiltersState>([])

const columnVisibility = ref<VisibilityState>({})

const rowSelection = ref<RowSelectionState>({})

const table = useVueTable({
    get data() {
        return props.data
    },

    get columns() {
        return props.columns
    },

    state: {
        get sorting() {
            return sorting.value
        },

        get columnFilters() {
            return columnFilters.value
        },

        get columnVisibility() {
            return columnVisibility.value
        },

        get rowSelection() {
            return rowSelection.value
        },
    },

    enableRowSelection: true,

    onSortingChange: updater => {
        sorting.value =
            updater instanceof Function
                ? updater(sorting.value)
                : updater
    },

    onColumnFiltersChange: updater => {
        columnFilters.value =
            updater instanceof Function
                ? updater(columnFilters.value)
                : updater
    },

    onColumnVisibilityChange: updater => {
        columnVisibility.value =
            updater instanceof Function
                ? updater(columnVisibility.value)
                : updater
    },

    onRowSelectionChange: updater => {
        rowSelection.value =
            updater instanceof Function
                ? updater(rowSelection.value)
                : updater
    },

    getCoreRowModel: getCoreRowModel(),

    getSortedRowModel: getSortedRowModel(),
})

watch(
    () => props.data,
    () => {
        rowSelection.value = {}
    },
)
</script>

<template>

    <DataTableSkeleton
        v-if="loading"
        :columns="columns.length"
    />

    <DataTableEmpty
        v-else-if="table.getRowModel().rows.length === 0"
        :title="emptyTitle"
        :description="emptyDescription"
    >
        <slot name="empty" />
    </DataTableEmpty>

    <div
        v-else
        class="rounded-lg border mb-0"
    >

        <Table>

            <!-- Header -->

            <TableHeader>

                <TableRow
                    v-for="headerGroup in table.getHeaderGroups()"
                    :key="headerGroup.id"
                >

                    <TableHead
                        v-for="header in headerGroup.headers"
                        :key="header.id"
                    >

                        <FlexRender
                            v-if="!header.isPlaceholder"
                            :render="
                                header.column.columnDef.header
                            "
                            :props="
                                header.getContext()
                            "
                        />

                    </TableHead>

                </TableRow>

            </TableHeader>

            <!-- Body -->

            <TableBody>

                <TableRow
                    v-for="row in table.getRowModel().rows"
                    :key="row.id"
                    :data-state="
                        row.getIsSelected()
                            ? 'selected'
                            : undefined
                    "
                >

                    <TableCell
                        v-for="cell in row.getVisibleCells()"
                        :key="cell.id"
                    >

                        <FlexRender
                            :render="
                                cell.column.columnDef.cell
                            "
                            :props="
                                cell.getContext()
                            "
                        />

                    </TableCell>

                </TableRow>

            </TableBody>

        </Table>

    </div>

</template>