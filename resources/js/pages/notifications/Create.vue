<script setup lang="ts">
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { notificationService } from '@/Services/NotificationService';
import type { NotificationFormData } from '@/types/domains';
import { NotificationChannel, NotificationStatus, getValidationErrors } from '@/types/domains';

const formData = ref<NotificationFormData>({
    title: '',
    channel: NotificationChannel.EMAIL,
    recipient: '',
    status: NotificationStatus.PENDING,
    sent_at: undefined,
});

const errors = ref<Record<string, string>>({});
const loading = ref(false);

const submit = async () => {
    loading.value = true;

    try {
        await notificationService.create(formData.value);
        router.visit('/notifications');
    } catch (err) {
        errors.value = getValidationErrors(err);
    } finally {
        loading.value = false;
    }
};
</script>

<template>
    <Head title="Create notification" />
    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div><h1 class="text-3xl font-semibold">Notification</h1></div>
            <Button variant="outline" @click="() => router.visit('/notifications')">Cancel</Button>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle>New notification</CardTitle>
            </CardHeader>
            <CardContent>
                <form @submit.prevent="submit" class="space-y-6">
                    <div class="grid gap-6 md:grid-cols-2">
                        <div class="col-span-2 space-y-2">
                            <Label for="title">Title *</Label>
                            <Input id="title" v-model="formData.title" type="text" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="channel">Channel *</Label>
                            <Select v-model="formData.channel" :disabled="loading">
                                <SelectTrigger id="channel"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="email">Email</SelectItem>
                                    <SelectItem value="sms">SMS</SelectItem>
                                    <SelectItem value="in_app">In App</SelectItem>
                                    <SelectItem value="push">Push</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="space-y-2">
                            <Label for="recipient">Recipient *</Label>
                            <Input id="recipient" v-model="formData.recipient" type="text" :disabled="loading" />
                        </div>
                        <div class="space-y-2">
                            <Label for="status">Status *</Label>
                            <Select v-model="formData.status" :disabled="loading">
                                <SelectTrigger id="status"><SelectValue /></SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="pending">Pending</SelectItem>
                                    <SelectItem value="sent">Sent</SelectItem>
                                    <SelectItem value="failed">Failed</SelectItem>
                                    <SelectItem value="read">Read</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="space-y-2">
                            <Label for="sent_at">Sent at</Label>
                            <Input id="sent_at" v-model="formData.sent_at" type="datetime-local" :disabled="loading" />
                        </div>
                    </div>
                    <div class="flex justify-end gap-4">
                        <Button variant="outline" @click="() => router.visit('/notifications')" :disabled="loading">Cancel</Button>
                        <Button type="submit" :disabled="loading">Create</Button>
                    </div>
                </form>
            </CardContent>
        </Card>
    </div>
</template>
