<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { organizationService } from '@/Services/OrganizationService';
import type { Organization, OrganizationFormData } from '@/types/domains';
import { getValidationErrors } from '@/types/domains';

const props = defineProps<{ organization: Organization }>();
const formData = ref<OrganizationFormData>({
    name: props.organization.name,
    slug: props.organization.slug,
    billing_email: props.organization.billing_email,
    country: props.organization.country,
    timezone: props.organization.timezone,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;

    try {
        await organizationService.update(props.organization.id, formData.value);
        router.visit('/organizations');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Edit organization" />
    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div><h1 class="text-3xl font-semibold">{{ organization.name }}</h1></div>
            <Button variant="outline" @click="() => router.visit('/organizations')">Cancel</Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Organization</CardTitle>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="name">Name *</Label>
                            <Input id="name" v-model="formData.name" type="text" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="slug">Slug *</Label>
                            <Input id="slug" v-model="formData.slug" type="text" :disabled="loading" />
                        </div>
                        <div class="col-span-2 space-y-2">
                            <Label for="billing_email">Billing email *</Label>
                            <Input id="billing_email" v-model="formData.billing_email" type="email" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="country">Country *</Label>
                            <Input id="country" v-model="formData.country" type="text" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="timezone">Timezone *</Label>
                            <Input id="timezone" v-model="formData.timezone" type="text" :disabled="loading" />
                        </div>
                    </div>
                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/organizations')" :disabled="loading">Cancel</Button>
                        <Button type="submit" :disabled="loading">Update</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
