<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { Plus, TriangleAlert } from '@lucide/vue';
import { computed, ref } from 'vue';

import ConfirmationDialog from '@/components/ConfirmationDialog.vue';

import {
    DataTable,
    DataTableToolbar,
} from '@/components/data-table'

import { useDataTable } from '@/components/data-table/composables/useDataTable';
import DataTableActions from '@/components/data-table/DataTableActions.vue';
import DataTablePagination from '@/components/data-table/DataTablePagination.vue';
import PageHeader from '@/components/PageHeader.vue';
import { propertyService } from '@/modules/properties/services/PropertyService';
import { propertyColumns } from '@/modules/properties/tables/column';
import type { Property } from '@/modules/properties/types/properties';
import { index, create, edit } from '@/routes/properties';
import type { Paginated } from '@/types/pagination';



const props = defineProps<{
    properties: Paginated<Property>;
    filters: {
        search?: string;
        per_page?: number;
    };
}>();

const deletingId = ref<number | null>(null);

const deleteDialogOpen = ref(false)
const propertyToDelete = ref<Property | null>(null)

const {
    search,
    perPage,
    loading,
} = useDataTable({
    url: index.url(),

    filters: props.filters,

    only: [
        'properties',
        'filters',
    ],
})

const columns = computed(() =>
    propertyColumns({
        deletingId: deletingId.value,

        onEdit: property =>
            handleEdit(property.id),

        onDelete: property =>
            handleDelete(property),
    }),
)

const handleDelete = (property: Property) => {
    propertyToDelete.value = property

    deleteDialogOpen.value = true
}

const deleteProperty = async () => {
    if (!propertyToDelete.value) {
        return
    }

    try {
        deletingId.value =
            propertyToDelete.value.id

        await propertyService.delete(
            propertyToDelete.value.id,
        )

        router.reload({
            only: ['properties'],
            preserveUrl: true,
        })

        deleteDialogOpen.value = false

        propertyToDelete.value = null
    } finally {
        deletingId.value = null
    }
}

const handleEdit = (id: number) => {
    router.visit(edit(id).url);
};

</script>

<template>
    <Head title="Properties" />

    <div class="space-y-6 p-4 md:p-6">

		<PageHeader border>
			<div class="space-y-3">
				<p class="text-xs uppercase tracking-[0.3em] text-emerald-700">Property Management</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Properties</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Manage your property portfolio. Create, view, edit, or delete properties.
                    </p>
                </div>
			</div>
		</PageHeader>

		<DataTableToolbar
			v-model:search="search"
			v-model:perPage="perPage"
		>

			<template #actions>

				<DataTableActions>

					<Link
						:href="create().url"
						class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white"
					>
						<Plus class="h-4 w-4" />

						New Property

					</Link>

				</DataTableActions>

			</template>

		</DataTableToolbar>

		<DataTable
			:data="props.properties.data"
			:columns="columns"
			:loading="loading"
			empty-title="No properties found"
			empty-description="Create your first property."
		>
			<template #empty>
				<Link
					:href="create().url"
					class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white"
				>
					<Plus class="mr-2 h-4 w-4" />
					Create Property
				</Link>
			</template>
		</DataTable>

		<DataTablePagination
			:pagination="props.properties"
			:show-summary="true"
		/>

    </div>

	<ConfirmationDialog
		v-model:open="deleteDialogOpen"
		title="Delete Property"
		description="This action cannot be undone."
		:item-name="propertyToDelete?.name"
		confirm-text="Delete Property"
		confirm-variant="destructive"
		:loading="deletingId !== null"
		@confirm="deleteProperty"
	>
		<template #icon>
			<TriangleAlert
				class="h-12 w-12 text-destructive"
			/>
		</template>
		<div class="rounded-md bg-muted p-3 text-sm">
			This property currently has
			<strong>{{ propertyToDelete?.total_units }} unit(s)</strong>.
		</div>
	</ConfirmationDialog>
</template>