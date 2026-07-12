<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { announcementService } from '@/Services/AnnouncementService';
import type { AnnouncementFormData } from '@/types/domains';
import { AnnouncementPriority, AnnouncementStatus, getValidationErrors } from '@/types/domains';

const formData = ref<AnnouncementFormData>({
    property_id: 0,
    title: '',
    content: '',
    priority: AnnouncementPriority.MEDIUM,
    status: AnnouncementStatus.DRAFT,
    publish_at: undefined,
    audience: undefined,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;

    try {
        await announcementService.create(formData.value);
        router.visit('/announcements');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Create announcement" />
    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-amber-700">New announcement</p>
                <h1 class="text-3xl font-semibold tracking-tight">Create announcement</h1>
            </div>
            <Button variant="outline" @click="() => router.visit('/announcements')">Cancel</Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>Announcement</CardTitle>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="space-y-2">
                            <Label for="property_id">Property ID *</Label>
                            <Input id="property_id" v-model.number="formData.property_id" type="number" min="1" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="title">Title *</Label>
                            <Input id="title" v-model="formData.title" type="text" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="priority">Priority *</Label>
                            <Select v-model="formData.priority" :disabled="loading">
                                <SelectTrigger id="priority"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="low">Low</SelectItem>
                                    <SelectItem value="medium">Medium</SelectItem>
                                    <SelectItem value="high">High</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="space-y-2">
                            <Label for="status">Status *</Label>
                            <Select v-model="formData.status" :disabled="loading">
                                <SelectTrigger id="status"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="draft">Draft</SelectItem>
                                    <SelectItem value="published">Published</SelectItem>
                                    <SelectItem value="archived">Archived</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="col-span-2 space-y-2">
                            <Label for="content">Content *</Label>
                            <textarea id="content" v-model="formData.content" :disabled="loading" class="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50" rows="4"></textarea>
                        </div>
                        <div class="space-y-2">
                            <Label for="publish_at">Publish at</Label>
                            <Input id="publish_at" v-model="formData.publish_at" type="datetime-local" :disabled="loading" />
                        </div>
                    </div>

                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/announcements')" :disabled="loading">Cancel</Button>
                        <Button type="submit" :disabled="loading">{{ loading ? 'Creating...' : 'Create' }}</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
