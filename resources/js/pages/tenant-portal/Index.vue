<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';

type TenantProfile = {
    name: string;
    email: string;
    phone: string;
    unit: string;
    property: string;
    lease_start: string;
    lease_end: string;
};

type LeaseInfo = {
    address: string;
    unit: string;
    lease_type: string;
    start_date: string;
    end_date: string;
    monthly_rent: string;
};

type Invoice = {
    invoice_id: string;
    amount: string;
    due_date: string;
    status: string;
    period: string;
};

type Payment = {
    payment_id: string;
    amount: string;
    date: string;
    method: string;
    reference: string;
};

type Announcement = {
    title: string;
    posted_at: string;
    summary: string;
};

type MaintenanceRequest = {
    request_id: string;
    issue: string;
    submitted_at: string;
    status: string;
    priority: string;
};

defineProps<{
    tenantProfile: TenantProfile;
    leaseInfo: LeaseInfo;
    recentInvoices: Invoice[];
    recentPayments: Payment[];
    activeAnnouncements: Announcement[];
    maintenanceRequests: MaintenanceRequest[];
}>();
</script>

<template>
    <Head title="Tenant Portal" />

    <div class="space-y-6 p-4 md:p-6">
        <!-- Tenant Profile Card -->
        <section class="flex flex-col gap-4 rounded-3xl border border-sidebar-border/70 bg-background p-6 shadow-sm lg:flex-row lg:items-end lg:justify-between">
            <div class="space-y-3">
                <p class="text-xs uppercase tracking-[0.3em] text-violet-700">Tenant portal</p>
                <div class="space-y-1">
                    <h1 class="text-3xl font-semibold tracking-tight">Welcome, {{ tenantProfile.name }}</h1>
                    <p class="max-w-2xl text-sm text-muted-foreground">
                        Your lease, invoices, payments, announcements, and maintenance requests are here.
                    </p>
                </div>
            </div>

            <Link
                href="/dashboard"
                class="inline-flex items-center justify-center rounded-md border border-sidebar-border/70 bg-background px-4 py-2 text-sm font-medium transition hover:bg-muted"
            >
                Back to app
            </Link>
        </section>

        <!-- Lease Information Card -->
        <Card class="border-sidebar-border/70 bg-linear-to-br from-violet-50 to-fuchsia-50 dark:from-violet-950/20 dark:to-fuchsia-950/20">
            <CardHeader>
                <CardTitle class="text-xl">Your lease</CardTitle>
                <CardDescription>
                    Active lease agreement details and duration
                </CardDescription>
            </CardHeader>
            <CardContent>
                <div class="grid gap-4 md:grid-cols-3">
                    <div class="space-y-1">
                        <p class="text-sm text-muted-foreground">Address</p>
                        <p class="font-medium">{{ leaseInfo.address }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm text-muted-foreground">Unit</p>
                        <p class="font-medium">{{ leaseInfo.unit }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm text-muted-foreground">Monthly rent</p>
                        <p class="font-medium">{{ leaseInfo.monthly_rent }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm text-muted-foreground">Lease type</p>
                        <p class="font-medium">{{ leaseInfo.lease_type }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm text-muted-foreground">Start date</p>
                        <p class="font-medium">{{ leaseInfo.start_date }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-sm text-muted-foreground">End date</p>
                        <p class="font-medium">{{ leaseInfo.end_date }}</p>
                    </div>
                </div>
            </CardContent>
        </Card>

        <!-- Invoices and Payments Grid -->
        <section class="grid gap-4 lg:grid-cols-2">
            <!-- Recent Invoices -->
            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-xl">Recent invoices</CardTitle>
                    <CardDescription>
                        Your monthly rent bills and payment status
                    </CardDescription>
                </CardHeader>
                <CardContent class="overflow-x-auto">
                    <div class="space-y-3">
                        <div
                            v-for="invoice in recentInvoices"
                            :key="invoice.invoice_id"
                            class="flex items-center justify-between rounded-lg border border-sidebar-border/70 bg-muted/30 p-3"
                        >
                            <div class="flex-1">
                                <p class="font-medium text-foreground">{{ invoice.period }}</p>
                                <p class="text-sm text-muted-foreground">{{ invoice.invoice_id }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">{{ invoice.amount }}</p>
                                <Badge :variant="invoice.status === 'Paid' ? 'default' : 'secondary'" class="mt-1 rounded-full">
                                    {{ invoice.status }}
                                </Badge>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Recent Payments -->
            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-xl">Recent payments</CardTitle>
                    <CardDescription>
                        Your payment history and transaction records
                    </CardDescription>
                </CardHeader>
                <CardContent class="overflow-x-auto">
                    <div class="space-y-3">
                        <div
                            v-for="payment in recentPayments"
                            :key="payment.payment_id"
                            class="flex items-center justify-between rounded-lg border border-sidebar-border/70 bg-muted/30 p-3"
                        >
                            <div class="flex-1">
                                <p class="font-medium text-foreground">{{ payment.method }}</p>
                                <p class="text-sm text-muted-foreground">{{ payment.date }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold">{{ payment.amount }}</p>
                                <p class="text-xs text-muted-foreground">{{ payment.reference }}</p>
                            </div>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </section>

        <!-- Announcements and Maintenance Grid -->
        <section class="grid gap-4 lg:grid-cols-2">
            <!-- Active Announcements -->
            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-xl">Announcements</CardTitle>
                    <CardDescription>
                        Important updates from property management
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-3">
                    <div
                        v-for="announcement in activeAnnouncements"
                        :key="announcement.title"
                        class="rounded-lg border border-sidebar-border/70 bg-muted/30 p-3"
                    >
                        <p class="font-medium text-foreground">{{ announcement.title }}</p>
                        <p class="text-sm text-muted-foreground">{{ announcement.posted_at }}</p>
                        <p class="mt-2 text-sm">{{ announcement.summary }}</p>
                    </div>
                </CardContent>
            </Card>

            <!-- Maintenance Requests -->
            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-xl">Maintenance requests</CardTitle>
                    <CardDescription>
                        Your submitted requests and their status
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-3">
                    <div
                        v-for="request in maintenanceRequests"
                        :key="request.request_id"
                        class="flex items-start justify-between rounded-lg border border-sidebar-border/70 bg-muted/30 p-3"
                    >
                        <div class="flex-1">
                            <p class="font-medium text-foreground">{{ request.issue }}</p>
                            <p class="text-sm text-muted-foreground">{{ request.request_id }} • {{ request.submitted_at }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <Badge :variant="request.priority === 'High' ? 'destructive' : 'secondary'" class="rounded-full">
                                {{ request.priority }}
                            </Badge>
                            <Badge variant="outline" class="rounded-full border-sidebar-border/70">
                                {{ request.status }}
                            </Badge>
                        </div>
                    </div>
                </CardContent>
            </Card>
        </section>
    </div>
</template>
