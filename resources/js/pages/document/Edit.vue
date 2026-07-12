<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { documentService } from '@/Services/DocumentService';
import type { Document, DocumentFormData } from '@/types/domains';
import { getValidationErrors } from '@/types/domains';

const props = defineProps<{ document: Document }>();
const formData = ref<DocumentFormData>({
    property_id: props.document.property_id,
    tenant_id: props.document.tenant_id,
    title: props.document.title,
    document_type: props.document.document_type,
    file_path: props.document.file_path,
    description: props.document.description,
    uploaded_at: props.document.uploaded_at,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;

    try {
        await documentService.update(props.document.id, formData.value);
        router.visit('/documents');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Edit document" />
    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div><h1 class="text-3xl font-semibold">{{ document.title }}</h1></div>
            <Button variant="outline" @click="() => router.visit('/documents')">Cancel</Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Document</CardTitle>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="property_id">Property ID *</Label>
                            <Input id="property_id" v-model.number="formData.property_id" type="number" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="title">Title *</Label>
                            <Input id="title" v-model="formData.title" type="text" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="document_type">Type *</Label>
                            <Select v-model="formData.document_type" :disabled="loading">
                                <SelectTrigger id="document_type"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="lease">Lease</SelectItem>
                                    <SelectItem value="contract">Contract</SelectItem>
                                    <SelectItem value="invoice">Invoice</SelectItem>
                                    <SelectItem value="receipt">Receipt</SelectItem>
                                    <SelectItem value="maintenance">Maintenance</SelectItem>
                                    <SelectItem value="other">Other</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="space-y-2">
                            <Label for="file_path">File path *</Label>
                            <Input id="file_path" v-model="formData.file_path" type="text" :disabled="loading" />
                        </div>
                        <div class="col-span-2 space-y-2">
                            <Label for="description">Description</Label>
                            <Input id="description" v-model="formData.description" type="text" :disabled="loading" placeholder="Optional description" />
                        </div>
                    </div>
                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/documents')" :disabled="loading">Cancel</Button>
                        <Button type="submit" :disabled="loading">Update</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
