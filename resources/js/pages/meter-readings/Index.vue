<script setup lang="ts">
import { Head, Link, router } from '@inertiajs/vue3';
import { AlertCircle, Plus, Edit2, Trash2, Loader } from '@lucide/vue';
import { computed, ref } from 'vue';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { index, create, edit } from '@/routes/meter-readings';
import { meterReadingService } from '@/Services/MeterReadingService';
import type { MeterReading } from '@/types/domains';

const props = defineProps<{
    meterReadings: MeterReading[];
}>();

const deletingId = ref<number | null>(null);
const error = ref<string | null>(null);

const isEmpty = computed(() => props.meterReadings.length === 0);
const count = computed(() => props.meterReadings.length);

const handleDelete = async (id: number) => {
    if (!confirm('Are you sure you want to delete this meter reading?')) {
return;
}

    try {
        deletingId.value = id;
        error.value = null;
        await meterReadingService.delete(id);
        router.visit(index.url());
    } catch (err) {
        error.value = 'Failed to delete meter reading. Please try again.';
        console.error(err);
    } finally {
        deletingId.value = null;
    }
};

const handleEdit = (id: number) => {
    router.visit(edit(id).url);
};
</script>

<template>
    <Head title="Meter Readings" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-emerald-700">Meter Management</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Meter Readings</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Manage utility meter readings. Create, view, edit, or delete meter records.
                    </p>
                </div>
            </div>

            <Link
                :href="create().url"
                class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
            >
                <Plus class="h-4 w-4" />
                New Reading
            </Link>
        </section>

        <section v-if="count > 0" class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <Card class="border-sidebar-border/70">
                <CardHeader class="space-y-2 pb-2">
                    <CardDescription>Total Readings</CardDescription>
                    <CardTitle class="text-3xl">{{ count }}</CardTitle>
                </CardHeader>
                <CardContent class="pt-0 text-sm text-muted-foreground">
                    Recorded readings
                </CardContent>
            </Card>
        </section>

        <div v-if="error" class="flex items-center gap-3 rounded-lg border border-red-200 bg-red-50 p-4">
            <AlertCircle class="h-5 w-5 text-red-600" />
            <p class="font-medium text-red-900">{{ error }}</p>
        </div>

        <div v-if="isEmpty" class="rounded-lg border-2 border-dashed border-sidebar-border/70 bg-muted/20 p-12 text-center">
            <div class="space-y-4">
                <h3 class="font-semibold text-foreground">No meter readings yet</h3>
                <Link
                    :href="create().url"
                    class="inline-flex items-center gap-2 rounded-md bg-emerald-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-700"
                >
                    <Plus class="h-4 w-4" />
                    Record Reading
                </Link>
            </div>
        </div>

        <div v-if="!isEmpty" class="overflow-hidden rounded-lg border border-sidebar-border/70">
            <table class="w-full">
                <thead class="border-b border-sidebar-border/70 bg-muted/50">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Unit</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Type</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Current Reading</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Recorded At</th>
                        <th class="px-6 py-3 text-center text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sidebar-border/70">
                    <tr v-for="reading in meterReadings" :key="reading.id" class="hover:bg-muted/30 transition">
                        <td class="px-6 py-4">
                            <p class="font-medium text-foreground">{{ reading.unit_id }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-muted-foreground">{{ reading.reading_type }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-medium">{{ reading.current_reading }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm text-muted-foreground">{{ reading.recorded_at }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <button
                                    @click="handleEdit(reading.id)"
                                    class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-medium text-amber-600 hover:bg-amber-50 transition"
                                    title="Edit reading"
                                >
                                    <Edit2 class="h-3.5 w-3.5" />
                                </button>
                                <button
                                    @click="handleDelete(reading.id)"
                                    :disabled="deletingId === reading.id"
                                    class="inline-flex items-center gap-1 rounded px-2 py-1 text-xs font-medium text-red-600 hover:bg-red-50 transition disabled:opacity-50"
                                    title="Delete reading"
                                >
                                    <Loader v-if="deletingId === reading.id" class="h-3.5 w-3.5 animate-spin" />
                                    <Trash2 v-else class="h-3.5 w-3.5" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
