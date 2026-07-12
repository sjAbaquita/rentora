<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { propertyService } from '@/Services/PropertyService';
import type { PropertyFormData } from '@/types/domains';
import { PropertyType as PropertyTypeEnum, getValidationErrors } from '@/types/domains';

const formData = ref<PropertyFormData>({
    name: '',
    address: '',
    city: '',
    postal_code: '',
    property_type: PropertyTypeEnum.APARTMENT,
    total_units: 1,
    year_built: new Date().getFullYear(),
});

const createError = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    createError.value = {};

    try {
        await propertyService.create(formData.value);
    } catch (err) {
        createError.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Create property" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">Create property</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Add new property</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Register a new residential, commercial, or mixed-use property to your portfolio.
                    </p>
                </div>
            </div>

            <Button variant="outline" @click="() => router.visit('/properties')">
                Cancel
            </Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Property information</CardTitle>
                <CardDescription>
                    Enter the basic details of your property
                </CardDescription>
            </CardHeader>
            <CardContent>
                <div class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="name">Property name *</Label>
                            <Input
                                id="name"
                                v-model="formData.name"
                                type="text"
                                placeholder="Aurora Residences"
                                :class="{ 'border-red-500': createError.name }"
                                :disabled="loading"
                            />
                            <p v-if="createError.name" class="text-sm text-red-500">{{ createError.name }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="address">Address *</Label>
                            <Input
                                id="address"
                                v-model="formData.address"
                                type="text"
                                placeholder="123 Main Street"
                                :class="{ 'border-red-500': createError.address }"
                                :disabled="loading"
                            />
                            <p v-if="createError.address" class="text-sm text-red-500">{{ createError.address }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="city">City *</Label>
                            <Input
                                id="city"
                                v-model="formData.city"
                                type="text"
                                placeholder="Manila"
                                :class="{ 'border-red-500': createError.city }"
                                :disabled="loading"
                            />
                            <p v-if="createError.city" class="text-sm text-red-500">{{ createError.city }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="postal_code">Postal code *</Label>
                            <Input
                                id="postal_code"
                                v-model="formData.postal_code"
                                type="text"
                                placeholder="1000"
                                :class="{ 'border-red-500': createError.postal_code }"
                                :disabled="loading"
                            />
                            <p v-if="createError.postal_code" class="text-sm text-red-500">{{ createError.postal_code }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="property_type">Property type *</Label>
                            <Select v-model="formData.property_type" :disabled="loading">
                                <SelectTrigger id="property_type" :class="{ 'border-red-500': createError.property_type }">
                                    <SelectValue />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="apartment">Apartment</SelectItem>
                                    <SelectItem value="building">Building</SelectItem>
                                    <SelectItem value="house">House</SelectItem>
                                    <SelectItem value="boarding_house">Boarding House</SelectItem>
                                </SelectContent>
                            </Select>
                            <p v-if="createError.property_type" class="text-sm text-red-500">{{ createError.property_type }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="total_units">Total units *</Label>
                            <Input
                                id="total_units"
                                v-model.number="formData.total_units"
                                type="number"
                                min="1"
                                placeholder="1"
                                :class="{ 'border-red-500': createError.total_units }"
                                :disabled="loading"
                            />
                            <p v-if="createError.total_units" class="text-sm text-red-500">{{ createError.total_units }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="year_built">Year built *</Label>
                            <Input
                                id="year_built"
                                v-model.number="formData.year_built"
                                type="number"
                                min="1900"
                                :max="new Date().getFullYear()"
                                :placeholder="new Date().getFullYear().toString()"
                                :class="{ 'border-red-500': createError.year_built }"
                                :disabled="loading"
                            />
                            <p v-if="createError.year_built" class="text-sm text-red-500">{{ createError.year_built }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between gap-4">
						<div>
							<p v-if="createError.message" class="text-sm text-red-500">{{ createError.message }}</p>
						</div>
						<div class="flex justify-end gap-4">
							<Button variant="outline" @click="() => router.visit('/properties')" :disabled="loading">
								Cancel
							</Button>
							<Button type="submit" @click="submit" :disabled="loading">
								{{ loading ? 'Creating...' : 'Create property' }}
							</Button>
						</div>
                    </div>
                </div>
            </CardContent>
        </Card>
    </div>
</template>
