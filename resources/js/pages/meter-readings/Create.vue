<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { meterReadingService } from '@/Services/MeterReadingService';
import type { MeterReadingFormData } from '@/types/domains';
import { MeterReadingType, getValidationErrors } from '@/types/domains';

const formData = ref<MeterReadingFormData>({
    property_id: 0,
    unit_id: null,
    reading_type: MeterReadingType.WATER,
    previous_reading: 0,
    current_reading: 0,
    recorded_at: new Date().toISOString().split('T')[0],
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;

    try {
        await meterReadingService.create(formData.value);
        router.visit('/meter-readings');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Create meter reading" />
    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div><h1 class="text-3xl font-semibold">Meter Reading</h1></div>
            <Button variant="outline" @click="() => router.visit('/meter-readings')">Cancel</Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>New reading</CardTitle>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="property_id">Property ID *</Label>
                            <Input id="property_id" v-model.number="formData.property_id" type="number" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="reading_type">Type *</Label>
                            <Select v-model="formData.reading_type" :disabled="loading">
                                <SelectTrigger id="reading_type"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="water">Water</SelectItem>
                                    <SelectItem value="electricity">Electricity</SelectItem>
                                    <SelectItem value="gas">Gas</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="space-y-2">
                            <Label for="unit_id">Unit ID</Label>
                            <Input id="unit_id" :value="formData.unit_id ?? ''" @input="formData.unit_id = $event.target.value ? Number($event.target.value) : null" type="number" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="previous_reading">Previous reading *</Label>
                            <Input id="previous_reading" v-model.number="formData.previous_reading" type="number" step="0.01" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="current_reading">Current reading *</Label>
                            <Input id="current_reading" v-model.number="formData.current_reading" type="number" step="0.01" :disabled="loading" />
                        </div>
                        <div class="col-span-2 space-y-2">
                            <Label for="recorded_at">Recorded at *</Label>
                            <Input id="recorded_at" v-model="formData.recorded_at" type="date" :disabled="loading" />
                        </div>
                    </div>
                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/meter-readings')" :disabled="loading">Cancel</Button>
                        <Button type="submit" :disabled="loading">Create</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
