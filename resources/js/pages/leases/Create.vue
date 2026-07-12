<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Combobox } from '@/components/ui/combobox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { leaseService } from '@/Services/LeaseService';
import type { LeaseFormData } from '@/types/domains';
import { getValidationErrors, LeaseStatus } from '@/types/domains';

interface Unit {
    id: number;
    label: string;
}

interface Tenant {
    id: number;
    label: string;
}

defineProps<{
    units: Unit[];
    tenants: Tenant[];
}>();

const formData = ref<LeaseFormData>({
    unit_id: 0,
    tenant_id: 0,
    lease_start: '',
    lease_end: '',
    monthly_rent: 0,
    deposit: 0,
    status: LeaseStatus.ACTIVE,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    errors.value = {};

    try {
        await leaseService.create(formData.value);
        // router.visit('/leases');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Create lease" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">Create lease</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Add new lease</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Create a new lease agreement between a tenant and unit.
                    </p>
                </div>
            </div>

            <Button variant="outline" @click="() => router.visit('/leases')">
                Cancel
            </Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Lease information</CardTitle>
                <CardDescription>
                    Enter the lease details
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Combobox
                                label="Unit"
                                placeholder="Select a unit..."
                                search-placeholder="Search units..."
                                :items="units"
                                :model-value="formData.unit_id"
                                :error="errors.unit_id"
                                :disabled="loading"
                                :required="true"
                                @update:model-value="(val) => formData.unit_id = val ?? 0"
                            />
                        </div>

                        <div class="space-y-2">
                            <Combobox
                                label="Tenant"
                                placeholder="Select a tenant..."
                                search-placeholder="Search tenants..."
                                :items="tenants"
                                :model-value="formData.tenant_id"
                                :error="errors.tenant_id"
                                :disabled="loading"
                                :required="true"
                                @update:model-value="(val) => formData.tenant_id = val ?? 0"
                            />
                        </div>

                        <div class="space-y-2">
                            <Label for="lease_start">Lease start *</Label>
                            <Input
                                id="lease_start"
                                v-model="formData.lease_start"
                                type="date"
                                :class="{ 'border-red-500': errors.lease_start }"
                                :disabled="loading"
                            />
                            <p v-if="errors.lease_start" class="text-sm text-red-500">{{ errors.lease_start }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="lease_end">Lease end</Label>
                            <Input
                                id="lease_end"
                                v-model="formData.lease_end"
                                type="date"
                                :class="{ 'border-red-500': errors.lease_end }"
                                :disabled="loading"
                            />
                            <p v-if="errors.lease_end" class="text-sm text-red-500">{{ errors.lease_end }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="monthly_rent">Monthly rent *</Label>
                            <Input
                                id="monthly_rent"
                                v-model.number="formData.monthly_rent"
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="0"
                                :class="{ 'border-red-500': errors.monthly_rent }"
                                :disabled="loading"
                            />
                            <p v-if="errors.monthly_rent" class="text-sm text-red-500">{{ errors.monthly_rent }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="deposit">Deposit *</Label>
                            <Input
                                id="deposit"
                                v-model.number="formData.deposit"
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="0"
                                :class="{ 'border-red-500': errors.deposit }"
                                :disabled="loading"
                            />
                            <p v-if="errors.deposit" class="text-sm text-red-500">{{ errors.deposit }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="status">Status *</Label>
                            <Select v-model="formData.status" :disabled="loading">
                                <SelectTrigger id="status" :class="{ 'border-red-500': errors.status }">
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="active">Active</SelectItem>
                                    <SelectItem value="ended">Ended</SelectItem>
                                    <SelectItem value="terminated">Terminated</SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="errors.status" class="text-sm text-red-500">{{ errors.status }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/leases')" :disabled="loading">
                            Cancel
                        </Button>
                        <Button type="submit" :disabled="loading">
                            {{ loading ? 'Creating...' : 'Create lease' }}
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
