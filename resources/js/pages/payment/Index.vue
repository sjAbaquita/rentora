<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { AlertCircle, Plus, Edit2, Trash2, Loader } from '@lucide/vue';
import { computed, ref } from 'vue';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { index, create, edit } from '@/routes/payments';
import { paymentService } from '@/Services/PaymentService';
import type { Payment } from '@/types/domains';

const props = defineProps<{
    payments: Payment[];
}>();

const deletingId = ref<number | null>(null);
const error = ref<string | null>(null);

const isEmpty = computed(() => props.payments.length === 0);
const count = computed(() => props.payments.length);

const handleDelete = async (id: number) => {
    if (!confirm('Are you sure you want to delete this payment?')) {
return;
}

    try {
        deletingId.value = id;
        error.value = null;
        await paymentService.delete(id);
        router.visit(index.url());
    } catch (err) {
        error.value = 'Failed to delete payment. Please try again.';
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
    <Head title="Payments" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-emerald-700">Payment Management</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Payments</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Manage tenant payments. Record, view, edit, or delete payment transactions.
                    </p>
                </div>
            </div>

            <Link
                :href="create().url"
                class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
            >
                <Plus class="h-4 w-4" />
                New Payment
            </Link>
        </section>

        <section v-if="count > 0" class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <Card class="border-sidebar-border/70">
                <CardHeader class="space-y-2 pb-2">
                    <CardDescription>Total Payments</CardDescription>
                    <CardTitle class="text-3xl">{{ count }}</CardTitle>
                </CardHeader>
                <CardContent class="pt-0 text-sm text-muted-foreground">
                    Processed and recorded
                </CardContent>
            </Card>
        </section>

        <div v-if="error" class="flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 p-4">
            <AlertCircle class="h-5 w-5 text-red-600" />
            <p class="font-medium text-red-900">{{ error }}</p>
        </div>

        <div v-if="isEmpty" class="rounded-lg border-2 border-dashed border-sidebar-border/70 bg-muted/20 p-12 text-center">
            <div class="space-y-4">
                <h3 class="font-semibold text-foreground">No payments yet</h3>
                <Link
                    :href="create().url"
                    class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
                >
                    <Plus class="h-4 w-4" />
                    Record Payment
                </Link>
            </div>
        </div>

        <div v-if="!isEmpty" class="overflow-hidden rounded-lg border border-sidebar-border/70">
            <table class="w-full">
                <thead class="border-b border-sidebar-border/70 bg-muted/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Reference</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Tenant</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Amount</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Date</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sidebar-border/70">
                    <tr v-for="payment in payments" :key="payment.id" class="hover:bg-muted/30 transition">
                        <td class="px-6 py-4">
                            <p class="font-medium text-foreground">PAY-{{ payment.id }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-muted-foreground">{{ payment.tenant_id }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium">{{ payment.amount }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-muted-foreground">{{ payment.paid_at }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    @click="handleEdit(payment.id)"
                                    class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-medium text-amber-600 hover:bg-amber-50 transition"
                                    title="Edit payment"
                                >
                                    <Edit2 class="h-3.5 w-3.5" />
                                </button>
                                <button
                                    @click="handleDelete(payment.id)"
                                    :disabled="deletingId === payment.id"
                                    class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-medium text-red-600 hover:bg-red-50 transition disabled:opacity-50"
                                    title="Delete payment"
                                >
                                    <Loader v-if="deletingId === payment.id" class="h-3.5 w-3.5 animate-spin" />
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
