<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

type SummaryCard = {
    label: string;
    value: string;
    detail: string;
};

type Option = {
    value: string;
    label: string;
};

type Integration = {
    gateway: string;
    status: string;
    live_mode: string;
    configured_at: string;
    transaction_count: string;
};

defineProps<{
    summaryCards: SummaryCard[];
    gateways: Option[];
    integrations: Integration[];
    nextSteps: string[];
}>();
</script>

<template>
    <Head title="Payment Integration" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-green-700">Payment integration</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Payment gateways</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Configure and monitor GCash, Maya, and Stripe payment channel integration.
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
                    <CardTitle class="text-xl">Supported gateways</CardTitle>
                    <CardDescription>
                        Three major payment channels for your region.
                    </CardDescription>
                </CardHeader>
                <CardContent class="flex flex-wrap gap-2">
                    <Badge v-for="gateway in gateways" :key="gateway.value" variant="outline" class="rounded-full border-sidebar-border/70 px-3 py-1">
                        {{ gateway.label }}
                    </Badge>
                </CardContent>
            </Card>

            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-xl">Next steps</CardTitle>
                    <CardDescription>
                        Integration setup is just the beginning—webhook and reconciliation come next.
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <ul class="space-y-3 text-sm text-muted-foreground">
                        <li v-for="step in nextSteps" :key="step" class="flex items-start gap-3">
                            <span class="mt-1 h-2 w-2 rounded-full bg-green-500" />
                            <span>{{ step }}</span>
                        </li>
                    </ul>
                </CardContent>
            </Card>
        </section>

        <Card class="border-sidebar-border/70">
            <CardHeader>
                <CardTitle class="text-xl">Integration status</CardTitle>
                <CardDescription>
                    Current configuration and transaction volume per gateway.
                </CardDescription>
            </CardHeader>
            <CardContent class="overflow-x-auto">
                <div class="min-w-180 space-y-3">
                    <div class="grid grid-cols-[1fr_0.8fr_0.8fr_1fr_1fr] gap-3 border-b border-sidebar-border/70 pb-3 text-xs font-medium uppercase tracking-[0.2em] text-muted-foreground">
                        <span>Gateway</span>
                        <span>Status</span>
                        <span>Live mode</span>
                        <span>Configured</span>
                        <span>Transactions</span>
                    </div>

                    <div
                        v-for="integration in integrations"
                        :key="integration.gateway"
                        class="grid grid-cols-[1fr_0.8fr_0.8fr_1fr_1fr] gap-3 rounded-2xl border border-sidebar-border/70 bg-muted/30 p-4 text-sm"
                    >
                        <div>
                            <p class="font-medium text-foreground">{{ integration.gateway }}</p>
                        </div>
                        <div>
                            <Badge variant="secondary" class="rounded-full">{{ integration.status }}</Badge>
                        </div>
                        <div class="text-muted-foreground">{{ integration.live_mode }}</div>
                        <div class="text-muted-foreground">{{ integration.configured_at }}</div>
                        <div class="text-muted-foreground">{{ integration.transaction_count }}</div>
                    </div>
                </div>
            </CardContent>
        </Card>
    </div>
</template>
