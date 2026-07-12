<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { paymentService } from '@/Services/PaymentService';
import type { Payment, PaymentFormData } from '@/types/domains';
import { getValidationErrors } from '@/types/domains';

const props = defineProps<{ payment: Payment }>();

const formData = ref<PaymentFormData>({
    invoice_id: props.payment.invoice_id,
    tenant_id: props.payment.tenant_id,
    amount: props.payment.amount,
    method: props.payment.method,
    paid_at: props.payment.paid_at,
    reference_number: props.payment.reference_number,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    errors.value = {};

    try {
        await paymentService.update(props.payment.id, formData.value);
        router.visit('/payments');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Edit payment" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">Edit payment</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Payment #{{ payment.id }}</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Update the payment details.
                    </p>
                </div>
            </div>

            <Button variant="outline" @click="() => router.visit('/payments')">
                Cancel
            </Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Payment information</CardTitle>
                <CardDescription>
                    Modify the payment details
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="invoice_id">Invoice ID *</Label>
                            <Input
                                id="invoice_id"
                                v-model.number="formData.invoice_id"
                                type="number"
                                min="1"
                                :class="{ 'border-red-500': errors.invoice_id }"
                                :disabled="loading"
                            />
                            <p v-if="errors.invoice_id" class="text-sm text-red-500">{{ errors.invoice_id }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="amount">Amount *</Label>
                            <Input
                                id="amount"
                                v-model.number="formData.amount"
                                type="number"
                                min="0"
                                step="0.01"
                                :class="{ 'border-red-500': errors.amount }"
                                :disabled="loading"
                            />
                            <p v-if="errors.amount" class="text-sm text-red-500">{{ errors.amount }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="method">Payment method *</Label>
                            <Select v-model="formData.method" :disabled="loading">
                                <SelectTrigger id="method" :class="{ 'border-red-500': errors.method }">
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="bank_transfer">Bank Transfer</SelectItem>
                                    <SelectItem value="credit_card">Credit Card</SelectItem>
                                    <SelectItem value="cash">Cash</SelectItem>
                                    <SelectItem value="check">Check</SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="errors.method" class="text-sm text-red-500">{{ errors.method }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="paid_at">Payment date *</Label>
                            <Input
                                id="paid_at"
                                v-model="formData.paid_at"
                                type="date"
                                :class="{ 'border-red-500': errors.paid_at }"
                                :disabled="loading"
                            />
                            <p v-if="errors.paid_at" class="text-sm text-red-500">{{ errors.paid_at }}</p>
                        </div>

                        <div class="col-span-2 space-y-2">
                            <Label for="reference_number">Reference number *</Label>
                            <Input
                                id="reference_number"
                                v-model="formData.reference_number"
                                type="text"
                                :class="{ 'border-red-500': errors.reference_number }"
                                :disabled="loading"
                            />
                            <p v-if="errors.reference_number" class="text-sm text-red-500">{{ errors.reference_number }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/payments')" :disabled="loading">
                            Cancel
                        </Button>
                        <Button type="submit" :disabled="loading">
                            {{ loading ? 'Updating...' : 'Update payment' }}
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
