<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { tenantService } from '@/Services/TenantService';
import type { TenantFormData } from '@/types/domains';
import { getValidationErrors } from '@/types/domains';

defineProps<{
    errors: Record<string, string>;
}>();

const formData = ref<TenantFormData>({
    first_name: '',
    last_name: '',
    email: '',
    phone: '',
    date_of_birth: undefined,
    nationality: '',
});

const createError = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;
    createError.value = {};

    try {
        await tenantService.create(formData.value);
        // router.visit('/tenants');
    } catch (err) {
        createError.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Create tenant" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">Create tenant</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Add new tenant</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Register a new tenant to your property management system.
                    </p>
                </div>
            </div>

            <Button variant="outline" @click="() => router.visit('/tenants')">
                Cancel
            </Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Tenant information</CardTitle>
                <CardDescription>
                    Enter the details of the new tenant
                </CardDescription>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="first_name">First name *</Label>
                            <Input
                                id="first_name"
                                v-model="formData.first_name"
                                type="text"
                                placeholder="John"
                                :class="{ 'border-red-500': errors.first_name }"
                                :disabled="loading"
                            />
                            <p v-if="errors.first_name" class="text-sm text-red-500">{{ errors.first_name }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="last_name">Last name *</Label>
                            <Input
                                id="last_name"
                                v-model="formData.last_name"
                                type="text"
                                placeholder="Doe"
                                :class="{ 'border-red-500': errors.last_name }"
                                :disabled="loading"
                            />
                            <p v-if="errors.last_name" class="text-sm text-red-500">{{ errors.last_name }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="email">Email *</Label>
                            <Input
                                id="email"
                                v-model="formData.email"
                                type="email"
                                placeholder="john@example.com"
                                :class="{ 'border-red-500': errors.email }"
                                :disabled="loading"
                            />
                            <p v-if="errors.email" class="text-sm text-red-500">{{ errors.email }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="phone">Phone *</Label>
                            <Input
                                id="phone"
                                v-model="formData.phone"
                                type="tel"
                                placeholder="+1-555-0000"
                                :class="{ 'border-red-500': errors.phone }"
                                :disabled="loading"
                            />
                            <p v-if="errors.phone" class="text-sm text-red-500">{{ errors.phone }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="date_of_birth">Date of birth</Label>
                            <Input
                                id="date_of_birth"
                                v-model="formData.date_of_birth"
                                type="date"
                                :class="{ 'border-red-500': errors.date_of_birth }"
                                :disabled="loading"
                            />
                            <p v-if="errors.date_of_birth" class="text-sm text-red-500">{{ errors.date_of_birth }}</p>
                        </div>

                        <div class="space-y-2">
                            <Label for="nationality">Nationality *</Label>
                            <Input
                                id="nationality"
                                v-model="formData.nationality"
                                type="text"
                                placeholder="Filipino"
                                :class="{ 'border-red-500': errors.nationality }"
                                :disabled="loading"
                            />
                            <p v-if="errors.nationality" class="text-sm text-red-500">{{ errors.nationality }}</p>
                        </div>
                    </div>

                    <div class="flex justify-between gap-4">
						<div>
							<p v-if="createError.message" class="text-sm text-red-500">{{ createError.message }}</p>
						</div>
						<div class="flex justify-end gap-4">
							<Button variant="outline" @click="() => router.visit('/tenants')" :disabled="loading">
								Cancel
							</Button>
							<Button type="submit" :disabled="loading">
								{{ loading ? 'Creating...' : 'Create tenant' }}
							</Button>
						</div>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
