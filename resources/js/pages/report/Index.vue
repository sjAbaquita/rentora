<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

type SummaryCard = {
    label: string;
    value: string;
    detail: string;
};

type ReportRow = {
    title: string;
    scope: string;
    period: string;
    status: string;
    detail: string;
};

defineProps<{
    summaryCards: SummaryCard[];
    reportTypes: string[];
    exportFormats: string[];
    reports: ReportRow[];
    nextSteps: string[];
}>();
</script>

<template>
    <Head title="Reports" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-indigo-700">Reports module</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Reports overview</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        This slice centralizes income, occupancy, and collection reporting with export-ready output.
                    </p>
                </div>
            </div>

            <Link
                href="/dashboard"
                class="inline-flex items-center justify-center rounded-md border border-sidebar-border/70 bg-background px-4 py-2 text-sm font-medium transition hover:bg-muted"
            >
                Back to dashboard
            </Link>
        </section>

        <section class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            <Card v-for="card in summaryCards" :key="card.label" class="border-sidebar-border/70">
                <CardHeader class="space-y-2 pb-2">
                    <CardDescription>{{ card.label }}</CardDescription>
                    <CardTitle class="text-3xl">{{ card.value }}</CardTitle>
                </CardHeader>
                <CardContent class="pt-0 text-sm text-muted-foreground">
                    {{ card.detail }}
                </CardContent>
            </Card>
        </section>

        <section class="grid gap-4 lg:grid-cols-[0.8fr_1.2fr]">
            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-xl">Report families</CardTitle>
                    <CardDescription>
                        Reporting stays focused on the operational and financial views in the PRD.
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-4">
                    <div>
                        <p class="mb-2 text-xs uppercase tracking-[0.2em] text-muted-foreground">Types</p>
                        <div class="flex flex-wrap gap-2">
                            <Badge v-for="reportType in reportTypes" :key="reportType" variant="outline" class="rounded-full border-sidebar-border/70 px-3 py-1">
                                {{ reportType }}
                            </Badge>
                        </div>
                    </div>
                    <div>
                        <p class="mb-2 text-xs uppercase tracking-[0.2em] text-muted-foreground">Exports</p>
                        <div class="flex flex-wrap gap-2">
                            <Badge v-for="format in exportFormats" :key="format" variant="secondary" class="rounded-full px-3 py-1">
                                {{ format }}
                            </Badge>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-xl">Next steps</CardTitle>
                    <CardDescription>
                        The reporting layer will attach to live aggregates in a later slice.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <ul class="space-y-3 text-sm text-muted-foreground">
                        <li v-for="step in nextSteps" :key="step" class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 rounded-full bg-indigo-500" />
                            <span>{{ step }}</span>
                        </li>
                    </ul>
                </CardContent>
            </Card>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle class="text-xl">Recent reports</CardTitle>
                <CardDescription>
                    Sample report runs show how the final reporting table can read.
                </CardDescription>
            </CardHeader>
            <CardContent class="overflow-x-auto">
                <div class="min-w-180 space-y-3">
                    <div class="grid grid-cols-[1.3fr_0.8fr_0.8fr_0.7fr_1.4fr] gap-3 border-b border-sidebar-border/70 pb-3 text-xs font-medium uppercase tracking-[0.2em] text-muted-foreground">
                        <span>Title</span>
                        <span>Scope</span>
                        <span>Period</span>
                        <span>Status</span>
                        <span>Detail</span>
                    </div>

                    <div
                        v-for="report in reports"
                        :key="report.title"
                        class="grid grid-cols-[1.3fr_0.8fr_0.8fr_0.7fr_1.4fr] gap-3 rounded-2xl border border-sidebar-border/70 bg-muted/30 p-4 text-sm"
                    >
                        <div>
                            <p class="font-medium text-foreground">{{ report.title }}</p>
                        </div>
                        <div class="text-muted-foreground">{{ report.scope }}</div>
                        <div class="text-muted-foreground">{{ report.period }}</div>
                        <div>
                            <Badge variant="secondary" class="rounded-full">{{ report.status }}</Badge>
                        </div>
                        <div class="text-muted-foreground">{{ report.detail }}</div>
                    </div>
                </div>
            </CardContent>
        </Card>
    </div>
</template>