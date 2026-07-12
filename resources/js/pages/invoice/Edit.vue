<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { invoiceService } from '@/Services/InvoiceService';
import type { Invoice, InvoiceFormData } from '@/types/domains';
import { getValidationErrors } from '@/types/domains';

const props = defineProps<{ invoice: Invoice }>();

const formData = ref<InvoiceFormData>({
    lease_id: props.invoice.lease_id,
    invoice_number: props.invoice.invoice_number,
    billing_period: props.invoice.billing_period,
    amount_due: props.invoice.amount_due,
    late_fee: props.invoice.late_fee,
    due_date: props.invoice.due_date,
    status: props.invoice.status,
    description: props.invoice.description,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    errors.value = {};

    try {
        await invoiceService.update(props.invoice.id, formData.value);
        router.visit('/invoices');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head :title="`Edit invoice ${invoice.invoice_number}`" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">Edit invoice</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">{{ invoice.invoice_number }}</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Update the invoice details.
                    </p>
                </div>
            </div>

            <Button variant="outline" @click="() => router.visit('/invoices')">
                Cancel
            </Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Invoice information</CardTitle>
                <CardDescription>
                    Modify the invoice details
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="lease_id">Lease ID *</Label>
                            <Input
                                id="lease_id"
                                v-model.number="formData.lease_id"
                                type="number"
                                min="1"
                                placeholder="1"
                                :class="{ 'border-red-500': errors.lease_id }"
                                :disabled="loading"
                            />
                            <p v-if="errors.lease_id" class="text-sm text-red-500">{{ errors.lease_id }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="invoice_number">Invoice number *</Label>
                            <Input
                                id="invoice_number"
                                v-model="formData.invoice_number"
                                type="text"
                                placeholder="INV-001"
                                :class="{ 'border-red-500': errors.invoice_number }"
                                :disabled="loading"
                            />
                            <p v-if="errors.invoice_number" class="text-sm text-red-500">{{ errors.invoice_number }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="amount_due">Amount *</Label>
                            <Input
                                id="amount_due"
                                v-model.number="formData.amount_due"
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="0"
                                :class="{ 'border-red-500': errors.amount_due }"
                                :disabled="loading"
                            />
                            <p v-if="errors.amount_due" class="text-sm text-red-500">{{ errors.amount_due }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="due_date">Due date *</Label>
                            <Input
                                id="due_date"
                                v-model="formData.due_date"
                                type="date"
                                :class="{ 'border-red-500': errors.due_date }"
                                :disabled="loading"
                            />
                            <p v-if="errors.due_date" class="text-sm text-red-500">{{ errors.due_date }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="status">Status *</Label>
                            <Select v-model="formData.status" :disabled="loading">
                                <SelectTrigger id="status" :class="{ 'border-red-500': errors.status }">
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="draft">Draft</SelectItem>
                                    <SelectItem value="sent">Sent</SelectItem>
                                    <SelectItem value="paid">Paid</SelectItem>
                                    <SelectItem value="overdue">Overdue</SelectItem>
                                    <SelectItem value="cancelled">Cancelled</SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="errors.status" class="text-sm text-red-500">{{ errors.status }}</p>
                        </div>

                        <div class="col-span-2 space-y-2">
                            <Label for="description">Description</Label>
                            <textarea id="description" v-model="formData.description" placeholder="Invoice description" :disabled="loading" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" :class="{ 'border-red-500': errors.description }" rows="4"></textarea>
                            <p v-if="errors.description" class="text-sm text-red-500">{{ errors.description }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/invoices')" :disabled="loading">
                            Cancel
                        </Button>
                        <Button type="submit" :disabled="loading">
                            {{ loading ? 'Updating...' : 'Update invoice' }}
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
