<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { AlertCircle, Plus, Edit2, Trash2, Loader } from '@lucide/vue';
import { computed, ref } from 'vue';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { index, create, edit } from '@/routes/invoices';
import { invoiceService } from '@/Services/InvoiceService';
import type { Invoice } from '@/types/domains';

const props = defineProps<{
    invoices: Invoice[];
}>();

const deletingId = ref<number | null>(null);
const error = ref<string | null>(null);

const isEmpty = computed(() => props.invoices.length === 0);
const count = computed(() => props.invoices.length);

const handleDelete = async (id: number) => {
    if (!confirm('Are you sure you want to delete this invoice?')) {
return;
}

    try {
        deletingId.value = id;
        error.value = null;
        await invoiceService.delete(id);
        router.visit(index.url());
    } catch (err) {
        error.value = 'Failed to delete invoice. Please try again.';
        console.error(err);
    } finally {
        deletingId.value = null;
    }
};

const handleEdit = (id: number) => {
    router.visit(edit(id).url);
};
</script>

<template>
    <Head title="Invoices" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-emerald-700">Invoice Management</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Invoices</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Manage rental invoices. Create, view, edit, or delete invoice records.
                    </p>
                </div>
            </div>

            <Link
                :href="create().url"
                class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
            >
                <Plus class="h-4 w-4" />
                New Invoice
            </Link>
        </section>

        <section v-if="count > 0" class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <Card class="border-sidebar-border/70">
                <CardHeader class="space-y-2 pb-2">
                    <CardDescription>Total Invoices</CardDescription>
                    <CardTitle class="text-3xl">{{ count }}</CardTitle>
                </CardHeader>
                <CardContent class="pt-0 text-sm text-muted-foreground">
                    Generated and pending
                </CardContent>
            </Card>
        </section>

        <div v-if="error" class="flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 p-4">
            <AlertCircle class="h-5 w-5 text-red-600" />
            <p class="font-medium text-red-900">{{ error }}</p>
        </div>

        <div v-if="isEmpty" class="rounded-lg border-2 border-dashed border-sidebar-border/70 bg-muted/20 p-12 text-center">
            <div class="space-y-4">
                <h3 class="font-semibold text-foreground">No invoices yet</h3>
                <Link
                    :href="create().url"
                    class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
                >
                    <Plus class="h-4 w-4" />
                    Create Invoice
                </Link>
            </div>
        </div>

        <div v-if="!isEmpty" class="overflow-hidden rounded-lg border border-sidebar-border/70">
            <table class="w-full">
                <thead class="border-b border-sidebar-border/70 bg-muted/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Invoice #</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Lease</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Amount</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Due Date</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sidebar-border/70">
                    <tr v-for="invoice in invoices" :key="invoice.id" class="hover:bg-muted/30 transition">
                        <td class="px-6 py-4">
                            <p class="font-medium text-foreground">INV-{{ invoice.id }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-muted-foreground">{{ invoice.lease_id }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium">{{ invoice.amount_due }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-muted-foreground">{{ invoice.due_date }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    @click="handleEdit(invoice.id)"
                                    class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-medium text-amber-600 hover:bg-amber-50 transition"
                                    title="Edit invoice"
                                >
                                    <Edit2 class="h-3.5 w-3.5" />
                                </button>
                                <button
                                    @click="handleDelete(invoice.id)"
                                    :disabled="deletingId === invoice.id"
                                    class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-medium text-red-600 hover:bg-red-50 transition disabled:opacity-50"
                                    title="Delete invoice"
                                >
                                    <Loader v-if="deletingId === invoice.id" class="h-3.5 w-3.5 animate-spin" />
                                    <Trash2 v-else class="h-3.5 w-3.5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
