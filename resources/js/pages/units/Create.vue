<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Combobox } from '@/components/ui/combobox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { unitService } from '@/Services/UnitService';
import type { UnitFormData } from '@/types/domains';
import { UnitType, getValidationErrors } from '@/types/domains';

interface Property {
    id: number;
    label: string;
}

defineProps<{
    errors: Record<string, string>;
    properties: Property[];
}>();

const formData = ref<UnitFormData>({
    property_id: 0,
    unit_number: '',
    unit_type: UnitType.ONE_BED,
    floor_number: 1,
    area_sqm: 0,
    bedrooms: 1,
    bathrooms: 1,
});

const createError = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    createError.value = {};

    try {
        await unitService.create(formData.value);
        // router.visit('/units');
    } catch (err) {
        createError.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Create unit" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">Create unit</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Add new unit</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Register a new unit/apartment to a property.
                    </p>
                </div>
            </div>

            <Button variant="outline" @click="() => router.visit('/units')">
                Cancel
            </Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Unit information</CardTitle>
                <CardDescription>
                    Enter the details of the new unit
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Combobox
                                label="Property"
                                placeholder="Select a property..."
                                search-placeholder="Search properties..."
                                :items="properties"
                                :model-value="formData.property_id"
                                :error="errors.property_id"
                                :disabled="loading"
                                :required="true"
                                @update:model-value="(val) => formData.property_id = val ?? 0"
                            />
                        </div>

                        <div class="space-y-2">
                            <Label for="unit_number">Unit number *</Label>
                            <Input
                                id="unit_number"
                                v-model="formData.unit_number"
                                type="text"
                                placeholder="101"
                                :class="{ 'border-red-500': errors.unit_number }"
                                :disabled="loading"
                            />
                            <p v-if="errors.unit_number" class="text-sm text-red-500">{{ errors.unit_number }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="unit_type">Unit type *</Label>
                            <Select v-model="formData.unit_type" :disabled="loading">
                                <SelectTrigger id="unit_type" :class="{ 'border-red-500': errors.unit_type }">
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="studio">Studio</SelectItem>
                                    <SelectItem value="1bed">1 Bedroom</SelectItem>
                                    <SelectItem value="2bed">2 Bedrooms</SelectItem>
                                    <SelectItem value="3bed">3 Bedrooms</SelectItem>
                                    <SelectItem value="4bed">4 Bedrooms</SelectItem>
                                    <SelectItem value="penthouse">Penthouse</SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="errors.unit_type" class="text-sm text-red-500">{{ errors.unit_type }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="floor_number">Floor number *</Label>
                            <Input
                                id="floor_number"
                                v-model.number="formData.floor_number"
                                type="number"
                                min="1"
                                placeholder="1"
                                :class="{ 'border-red-500': errors.floor_number }"
                                :disabled="loading"
                            />
                            <p v-if="errors.floor_number" class="text-sm text-red-500">{{ errors.floor_number }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="area_sqm">Area (sqm) *</Label>
                            <Input
                                id="area_sqm"
                                v-model.number="formData.area_sqm"
                                type="number"
                                min="0"
                                step="0.01"
                                placeholder="50"
                                :class="{ 'border-red-500': errors.area_sqm }"
                                :disabled="loading"
                            />
                            <p v-if="errors.area_sqm" class="text-sm text-red-500">{{ errors.area_sqm }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="bedrooms">Bedrooms *</Label>
                            <Input
                                id="bedrooms"
                                v-model.number="formData.bedrooms"
                                type="number"
                                min="0"
                                placeholder="1"
                                :class="{ 'border-red-500': errors.bedrooms }"
                                :disabled="loading"
                            />
                            <p v-if="errors.bedrooms" class="text-sm text-red-500">{{ errors.bedrooms }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="bathrooms">Bathrooms *</Label>
                            <Input
                                id="bathrooms"
                                v-model.number="formData.bathrooms"
                                type="number"
                                min="0"
                                placeholder="1"
                                :class="{ 'border-red-500': errors.bathrooms }"
                                :disabled="loading"
                            />
                            <p v-if="errors.bathrooms" class="text-sm text-red-500">{{ errors.bathrooms }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between gap-4">
						<div>
							<p v-if="createError.message" class="text-sm text-red-500">{{ createError.message }}</p>
						</div>
						<div class="flex justify-end gap-4">
							<Button variant="outline" @click="() => router.visit('/units')" :disabled="loading">
								Cancel
							</Button>
							<Button type="submit" :disabled="loading">
								{{ loading ? 'Creating...' : 'Create unit' }}
							</Button>
						</div>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
