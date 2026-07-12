<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { AlertCircle, Plus, Edit2, Trash2, Loader } from '@lucide/vue';
import { watchDebounced } from '@vueuse/core';
import { computed, ref } from 'vue';
import PageHeader from '@/components/PageHeader.vue';
import Pagination from '@/components/Pagination.vue';
import { Badge } from '@/components/ui/badge';
// import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input'
// import { useFilters } from '@/composables/useFilters';
import { index, create, edit } from '@/routes/properties';
import { propertyService } from '@/Services/PropertyService';
import type { Paginated } from '@/types/pagination';
import type { Property } from '@/types/properties';


const props = defineProps<{
    properties: Paginated<Property>;
    filters: {
        search?: string;
        per_page?: number;
    };
}>();

const deletingId = ref<number | null>(null);
const error = ref<string | null>(null);

const isEmpty = computed(() => props.properties.data.length === 0);
// const count = computed(() => props.properties.total);

const search = ref(props.filters.search ?? '');
const perPage = ref(props.filters.per_page ?? 10);

// const {
//     search,
//     filteredItems: filteredProperties,
// } = useFilters(props.properties.data, ['name']);

const filteredProperties = computed(() => props.properties.data);

const handleDelete = async (id: number) => {
    if (!confirm('Are you sure you want to delete this property?')) {
		return;
	}

    try {
        deletingId.value = id;
        error.value = null;

        await propertyService.delete(id);
		
		router.reload({
			only: ['properties'],
			preserveUrl: true,
		});
        // router.visit(index.url());
    } catch (err) {
        error.value = 'Failed to delete property. Please try again.';
        console.error(err);
    } finally {
        deletingId.value = null;
    }
};

const handleEdit = (id: number) => {
    router.visit(edit(id).url);
};

watchDebounced(
    [search, perPage],
    ([searchValue, perPageValue]) => {
        router.get(
            index.url(),
            {
                search: searchValue,
                per_page: perPageValue,
        		page: 1,
            },
            {
                preserveState: true,
                preserveScroll: true,
                replace: true,
                only: ['properties', 'filters'],
            },
        );
    },
    {
        debounce: 400,
        maxWait: 1000,
    },
);
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

			<template #actions>
				<!-- SEARCH -->
				<Input v-model="search" placeholder="Search properties..." class="focus-visible:ring-2 focus-visible:ring-teal-500 focus-visible:border-teal-500" />
				
				<select
					v-model="perPage"
					class="h-9 rounded-md border bg-background px-3 text-sm"
				>
					<option :value="10">10</option>
					<option :value="25">25</option>
					<option :value="50">50</option>
					<option :value="100">100</option>
				</select>

				<Link
					:href="create().url"
					class="inline-flex items-center  whitespace-nowrap gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
				>
					<Plus class="h-4 w-4" />
					New Property
				</Link>
			</template>
		</PageHeader>

        <!-- Summary Stats -->
        <!-- <section v-if="count > 0" class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <Card class="border-sidebar-border/70">
                <CardHeader class="space-y-2 pb-2">
                    <CardDescription>Total Properties</CardDescription>
                    <CardTitle class="text-3xl">{{ count }}</CardTitle>
                </CardHeader>
                <CardContent class="pt-0 text-sm text-muted-foreground">
                    In your portfolio
                </CardContent>
            </Card>
        </section> -->

        <!-- Error State -->
        <div v-if="error" class="flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 p-4">
            <AlertCircle class="h-5 w-5 text-red-600" />
            <div class="flex-1">
                <p class="font-medium text-red-900">{{ error }}</p>
            </div>
        </div>

        <!-- Empty State -->
        <div v-if="isEmpty" class="rounded-lg border-2 border-dashed border-sidebar-border/70 bg-muted/20 p-12 text-center">
            <div class="space-y-4">
                <div>
                    <h3 class="font-semibold text-foreground">No properties yet</h3>
                    <p class="text-sm text-muted-foreground">Get started by creating your first property.</p>
                </div>
                <Link
                    :href="create().url"
                    class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
                >
                    <Plus class="h-4 w-4" />
                    Create Property
                </Link>
            </div>
        </div>

        <!-- Data Table -->
        <div v-if="!isEmpty" class="overflow-hidden rounded-lg border border-sidebar-border/70">
            <table class="w-full">
                <thead class="border-b border-sidebar-border/70 bg-muted/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Address</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">City</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Units</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sidebar-border/70">
                    <tr v-for="property in filteredProperties" :key="property.id" class="hover:bg-muted/30 transition">
                        <td class="px-6 py-4">
                            <p class="font-medium text-foreground">{{ property.name }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-muted-foreground">{{ property.address }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-muted-foreground">{{ property.city }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <Badge variant="outline" class="capitalize">{{ property.property_type.replace(/_/g, " ") }}</Badge>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium">{{ property.total_units }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    @click="handleEdit(property.id)"
                                    class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-medium text-amber-600 hover:bg-amber-50 transition"
                                    title="Edit property"
                                >
                                    <Edit2 class="h-3.5 w-3.5" />
                                </button>
                                <button
                                    @click="handleDelete(property.id)"
                                    :disabled="deletingId === property.id"
                                    class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-medium text-red-600 hover:bg-red-50 transition disabled:opacity-50"
                                    title="Delete property"
                                >
                                    <Loader v-if="deletingId === property.id" class="h-3.5 w-3.5 animate-spin" />
                                    <Trash2 v-else class="h-3.5 w-3.5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

		<select
			v-model="perPage"
			class="h-9 rounded-md border bg-background px-3 text-sm"
		>
			<option :value="10">10</option>
			<option :value="25">25</option>
			<option :value="50">50</option>
			<option :value="100">100</option>
		</select>

		<!-- Pagination -->
		<Pagination 
			:pagination="props.properties"
			label="properties"
		/>

    </div>
</template>