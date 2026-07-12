<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { expenseService } from '@/Services/ExpenseService';
import type { Expense, ExpenseFormData } from '@/types/domains';
import { getValidationErrors } from '@/types/domains';

const props = defineProps<{ expense: Expense }>();

const formData = ref<ExpenseFormData>({
    property_id: props.expense.property_id,
    category: props.expense.category,
    amount: props.expense.amount,
    expense_date: props.expense.expense_date,
    description: props.expense.description,
    reference_number: props.expense.reference_number,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;

    try {
        await expenseService.update(props.expense.id, formData.value);
        router.visit('/expenses');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Edit expense" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">Edit expense</p>
                <h1 class="text-3xl font-semibold tracking-tight">{{ expense.id }}</h1>
            </div>
            <Button variant="outline" @click="() => router.visit('/expenses')">Cancel</Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Expense details</CardTitle>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="property_id">Property ID *</Label>
                            <Input id="property_id" v-model.number="formData.property_id" type="number" min="1" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="category">Category *</Label>
                            <Select v-model="formData.category" :disabled="loading">
                                <SelectTrigger id="category"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="utilities">Utilities</SelectItem>
                                    <SelectItem value="repairs">Repairs</SelectItem>
                                    <SelectItem value="maintenance">Maintenance</SelectItem>
                                    <SelectItem value="insurance">Insurance</SelectItem>
                                    <SelectItem value="taxes">Taxes</SelectItem>
                                    <SelectItem value="administrative">Administrative</SelectItem>
                                    <SelectItem value="other">Other</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="space-y-2">
                            <Label for="amount">Amount *</Label>
                            <Input id="amount" v-model.number="formData.amount" type="number" min="0" step="0.01" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="expense_date">Date *</Label>
                            <Input id="expense_date" v-model="formData.expense_date" type="date" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="reference_number">Reference number</Label>
                            <Input id="reference_number" v-model="formData.reference_number" type="text" :disabled="loading" />
                        </div>
                        <div class="col-span-2 space-y-2">
                            <Label for="description">Description</Label>
                            <textarea id="description" v-model="formData.description" :disabled="loading" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" rows="4"></textarea>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/expenses')" :disabled="loading">Cancel</Button>
                        <Button type="submit" :disabled="loading">{{ loading ? 'Updating...' : 'Update' }}</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
