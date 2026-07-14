import { Edit2, Trash2 } from '@lucide/vue'
import type { ColumnDef } from '@tanstack/vue-table'
import { h } from 'vue'

import DataTableColumnHeader from '@/components/data-table/DataTableColumnHeader.vue'
import DataTableRowActions from '@/components/data-table/DataTableRowActions.vue'

import { Badge } from '@/components/ui/badge'

import type { Property } from '@/modules/properties/types/properties'

interface PropertyColumnOptions {
    deletingId: number | null
    onEdit: (property: Property) => void
    onDelete: (property: Property) => void
}

export function propertyColumns(
    options: PropertyColumnOptions,
): ColumnDef<Property>[] {

    return [
        {
            accessorKey: 'name',
            header: ({ column }) =>
                h(DataTableColumnHeader, {
                    column,
                    title: 'Name',
                }),
            cell: ({ row }) =>
                h(
                    'div',
                    {
                        class: 'font-medium',
                    },
                    row.original.name,
                ),
        },

        {
            accessorKey: 'address',
            header: ({ column }) =>
                h(DataTableColumnHeader, {
                    column,
                    title: 'Address',
                }),
        },

        {
            accessorKey: 'city',
            header: ({ column }) =>
                h(DataTableColumnHeader, {
                    column,
                    title: 'City',
                }),
        },

        {
            accessorKey: 'property_type',
            header: ({ column }) =>
                h(DataTableColumnHeader, {
                    column,
                    title: 'Type',
                }),
            cell: ({ row }) =>
                h(
                    Badge,
                    {
                        variant: 'outline',
                        class: 'capitalize',
                    },
                    () =>
                        row.original.property_type.replaceAll(
                            '_',
                            ' ',
                        ),
                ),
        },

        {
            accessorKey: 'total_units',
            header: ({ column }) =>
                h(DataTableColumnHeader, {
                    column,
                    title: 'Units',
                }),
            cell: ({ row }) =>
                h(
                    'div',
                    {
                        class: 'text-center font-medium',
                    },
                    row.original.total_units,
                ),
        },

        {
			id: 'actions',
			enableSorting: false,
			enableHiding: false,
			header: () => 'Actions',
			cell: ({ row }) =>

				h(DataTableRowActions, {
					row: row.original,

					actions: [
						{
							label: 'Edit',
							icon: Edit2,
							colorClass: 'text-amber-600',
							onClick: () => options.onEdit(row.original),
						},

						{
							label: 'Delete',
							icon: Trash2,
							colorClass: 'text-red-600',

							loading:
								options.deletingId ===
								row.original.id,

							onClick: () => options.onDelete(row.original),
						},

					],

				}),
		}
    ]
}