<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { maintenanceService } from '@/Services/MaintenanceService';
import type { Maintenance, MaintenanceFormData } from '@/types/domains';
import { getValidationErrors } from '@/types/domains';

const props = defineProps<{ maintenance: Maintenance }>();

const formData = ref<MaintenanceFormData>({
    tenant_id: props.maintenance.tenant_id,
    unit_id: props.maintenance.unit_id,
    title: props.maintenance.title,
    description: props.maintenance.description,
    priority: props.maintenance.priority,
    status: props.maintenance.status,
    assigned_to: props.maintenance.assigned_to ?? undefined,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    errors.value = {};

    try {
        await maintenanceService.update(props.maintenance.id, formData.value);
        router.visit('/maintenance');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head :title="`Edit ${maintenance.title}`" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">Edit request</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">{{ maintenance.title }}</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Update the maintenance request.
                    </p>
                </div>
            </div>

            <Button variant="outline" @click="() => router.visit('/maintenance')">
                Cancel
            </Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Request details</CardTitle>
                <CardDescription>Modify the maintenance request</CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="unit_id">Unit ID *</Label>
                            <Input id="unit_id" v-model.number="formData.unit_id" type="number" min="1" :disabled="loading" :class="{ 'border-red-500': errors.unit_id }" />
                            <p v-if="errors.unit_id" class="text-sm text-red-500">{{ errors.unit_id }}</p>
                        </div>
                        <div class="space-y-2">
                            <Label for="title">Title *</Label>
                            <Input id="title" v-model="formData.title" type="text" placeholder="Leaky faucet" :disabled="loading" :class="{ 'border-red-500': errors.title }" />
                            <p v-if="errors.title" class="text-sm text-red-500">{{ errors.title }}</p>
                        </div>
                        <div class="space-y-2">
                            <Label for="priority">Priority *</Label>
                            <Select v-model="formData.priority" :disabled="loading">
                                <SelectTrigger id="priority" :class="{ 'border-red-500': errors.priority }"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="low">Low</SelectItem>
                                    <SelectItem value="medium">Medium</SelectItem>
                                    <SelectItem value="high">High</SelectItem>
                                    <SelectItem value="emergency">Emergency</SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="errors.priority" class="text-sm text-red-500">{{ errors.priority }}</p>
                        </div>
                        <div class="space-y-2">
                            <Label for="status">Status *</Label>
                            <Select v-model="formData.status" :disabled="loading">
                                <SelectTrigger id="status" :class="{ 'border-red-500': errors.status }"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="open">Open</SelectItem>
                                    <SelectItem value="in_progress">In Progress</SelectItem>
                                    <SelectItem value="on_hold">On Hold</SelectItem>
                                    <SelectItem value="completed">Completed</SelectItem>
                                    <SelectItem value="cancelled">Cancelled</SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="errors.status" class="text-sm text-red-500">{{ errors.status }}</p>
                        </div>
                        <div class="space-y-2">
                            <Label for="assigned_to">Assigned to</Label>
                            <Input id="assigned_to" v-model="formData.assigned_to" type="text" placeholder="Technician name" :disabled="loading" :class="{ 'border-red-500': errors.assigned_to }" />
                            <p v-if="errors.assigned_to" class="text-sm text-red-500">{{ errors.assigned_to }}</p>
                        </div>
                        <div class="col-span-2 space-y-2">
                            <Label for="description">Description *</Label>
                            <textarea id="description" v-model="formData.description" placeholder="Describe the issue..." :disabled="loading" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" :class="{ 'border-red-500': errors.description }" rows="4"></textarea>
                            <p v-if="errors.description" class="text-sm text-red-500">{{ errors.description }}</p>
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/maintenance')" :disabled="loading">
                            Cancel
                        </Button>
                        <Button type="submit" :disabled="loading">
                            {{ loading ? 'Updating...' : 'Update request' }}
                        </Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
