import type { Component } from 'vue';

export interface DataTableColumn<T = unknown> {
    key: keyof T | string

    label: string

    width?: string

    align?: 'left' | 'center' | 'right'

    sortable?: boolean

    mobileHidden?: boolean

    format?: (row: T) => unknown

    badge?: (row: T) => string

    badgeVariant?:
        | 'default'
        | 'secondary'
        | 'outline'
        | 'destructive'
}

export interface DataTableAction<T = unknown> {
    label: string

    icon?: Component

    color?:
        | 'default'
        | 'primary'
        | 'success'
        | 'warning'
        | 'danger'

    onClick: (row: T) => void

    loading?: (row: T) => boolean
}