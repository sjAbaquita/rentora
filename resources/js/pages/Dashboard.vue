<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { Badge } from '@/components/ui/badge';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { dashboard } from '@/routes';
import announcements from '@/routes/announcements';
import documents from '@/routes/documents';
import expenses from '@/routes/expenses';
import invoices from '@/routes/invoices';
import leases from '@/routes/leases';
import maintenance from '@/routes/maintenance';
import meterReadings from '@/routes/meter-readings';
import notifications from '@/routes/notifications';
import organization from '@/routes/organization';
import paymentIntegrations from '@/routes/payment-integrations';
import payments from '@/routes/payments';
import properties from '@/routes/properties';
import reports from '@/routes/reports';
import tenantPortal from '@/routes/tenant-portal';
import tenants from '@/routes/tenants';
import units from '@/routes/units';

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
        ],
    },
});

const quickLinks = [
    { title: 'Properties', href: properties.index().url },
    { title: 'Tenants', href: tenants.index().url },
    { title: 'Units', href: units.index().url },
    { title: 'Leases', href: leases.index().url },
    { title: 'Invoices', href: invoices.index().url },
    { title: 'Payments', href: payments.index().url },
    { title: 'Maintenance', href: maintenance.index().url },
    { title: 'Expenses', href: expenses.index().url },
    { title: 'Announcements', href: announcements.index().url },
    { title: 'Documents', href: documents.index().url },
    { title: 'Reports', href: reports.index().url },
    { title: 'Meter Readings', href: meterReadings.index().url },
    { title: 'Notifications', href: notifications.index().url },
    { title: 'Tenant Portal', href: tenantPortal.index().url },
    { title: 'Payment Integrations', href: paymentIntegrations.index().url },
    { title: 'Organization', href: organization.index().url },
];

const roles = [
    {
        title: 'Owner',
        summary:
            'Oversees the full portfolio and approves the core operational flow.',
        capabilities: [
            'Properties',
            'Units',
            'Tenants',
            'Leases',
            'Invoices',
            'Payments',
            'Reports',
        ],
    },
    {
        title: 'Tenant',
        summary:
            'Lives inside the tenant portal for rent, receipts, and requests.',
        capabilities: [
            'Active lease',
            'Invoices',
            'Payments',
            'Receipts',
            'Maintenance requests',
            'Announcements',
        ],
    },
    {
        title: 'Staff',
        summary:
            'Supports day-to-day property operations across billing and maintenance.',
        capabilities: ['Tenants', 'Payments', 'Maintenance', 'Operational notes'],
    },
];

const propertyTypes = ['Apartment', 'Building', 'House', 'Boarding House'];

const modulePhases = [
    {
        phase: 'Phase 1',
        title: 'Core operating system',
        description:
            'Authentication, dashboard, property data, and tenant-facing billing flows.',
        modules: [
            'Authentication',
            'Dashboard',
            'Property',
            'Unit',
            'Tenant',
            'Lease',
            'Invoice',
            'Payment Recording',
            'Tenant Portal',
        ],
    },
    {
        phase: 'Phase 2',
        title: 'Operational depth',
        description:
            'Service requests, operating costs, meter readings, notifications, and reporting.',
        modules: [
            'Maintenance',
            'Expenses',
            'Meter Reading',
            'Notifications',
            'Reports',
            'PDF Receipts',
        ],
    },
    {
        phase: 'Phase 3',
        title: 'Payments and growth',
        description:
            'External payment rails and public reservation flow for future product expansion.',
        modules: [
            'GCash',
            'Maya',
            'Stripe',
            'Public Vacancy Website',
            'Reservation System',
        ],
    },
    {
        phase: 'Phase 4',
        title: 'SaaS foundation',
        description:
            'Multi-tenant growth, subscription management, and organization controls.',
        modules: [
            'SaaS Multi-tenancy',
            'Subscription Plans',
            'Organization Management',
        ],
    },
];

const designGoals = [
    'Modular code boundaries',
    'Maintainable domain structure',
    'Future SaaS conversion',
    'Strong TypeScript typing',
    'Reusable components',
    'No duplicated business logic',
    'Mobile responsive layout',
    'Desktop and tablet friendly',
];
</script>

<template>
    <Head title="Dashboard" />

    <div class="space-y-6 p-4 md:p-6">
        <section class="grid gap-4 lg:grid-cols-[1.35fr_0.65fr]">
            <Card class="overflow-hidden border-slate-900/10 bg-linear-to-br from-slate-950 via-slate-900 to-emerald-900 text-white shadow-2xl shadow-slate-950/20">
                <CardHeader class="space-y-4">
                    <div class="flex flex-wrap items-center gap-2 text-xs uppercase tracking-[0.3em] text-emerald-200/80">
                        <span>Rentora</span>
                        <span class="h-1 w-1 rounded-full bg-emerald-300/80" />
                        <span>Property management platform</span>
                    </div>
                    <CardTitle class="max-w-2xl text-3xl leading-tight md:text-4xl">
                        Built around owners, tenants, and staff - not a generic starter kit.
                    </CardTitle>
                    <CardDescription class="max-w-2xl text-base leading-7 text-slate-200">
                        The product model is intentionally domain-driven: properties, units, tenants,
                        leases, invoices, payments, maintenance, and reporting all fit into a modular
                        SaaS-ready structure.
                    </CardDescription>
                </CardHeader>
                <CardContent class="space-y-6">
                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-sm text-slate-300">User roles</p>
                            <p class="mt-1 text-2xl font-semibold">3</p>
                            <p class="mt-1 text-sm text-slate-300">Owner, Tenant, Staff</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-sm text-slate-300">Property types</p>
                            <p class="mt-1 text-2xl font-semibold">4</p>
                            <p class="mt-1 text-sm text-slate-300">Apartment, building, house, boarding house</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-sm text-slate-300">Core modules</p>
                            <p class="mt-1 text-2xl font-semibold">9</p>
                            <p class="mt-1 text-sm text-slate-300">Phase 1 scope</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            <p class="text-sm text-slate-300">Future-ready</p>
                            <p class="mt-1 text-2xl font-semibold">SaaS</p>
                            <p class="mt-1 text-sm text-slate-300">Multi-tenancy, subscriptions, organizations</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a
                            href="#roles"
                            class="inline-flex items-center justify-center rounded-md border border-white/10 bg-white px-4 py-2 text-sm font-medium text-slate-950 transition hover:bg-slate-100"
                        >
                            View roles
                        </a>
                        <Link
                            v-for="link in quickLinks"
                            :key="link.title"
                            :href="link.href"
                            class="inline-flex items-center justify-center rounded-md border border-white/10 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/15"
                        >
                            {{ link.title }}
                        </Link>
                        <a
                            href="#modules"
                            class="inline-flex items-center justify-center rounded-md border border-white/10 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/15"
                        >
                            Review modules
                        </a>
                        <a
                            href="#roadmap"
                            class="inline-flex items-center justify-center rounded-md border border-white/10 bg-white/10 px-4 py-2 text-sm font-medium text-white transition hover:bg-white/15"
                        >
                            See roadmap
                        </a>
                    </div>
                </CardContent>
            </Card>

            <Card class="border-sidebar-border/70 bg-background/90 backdrop-blur">
                <CardHeader>
                    <CardTitle class="text-xl">Design goals</CardTitle>
                    <CardDescription>
                        The codebase should stay easy to extend as domains and integrations are added.
                    </CardDescription>
                </CardHeader>
                <CardContent class="flex flex-wrap gap-2">
                    <Badge
                        v-for="goal in designGoals"
                        :key="goal"
                        variant="outline"
                        class="rounded-full border-sidebar-border/70 bg-slate-50 px-3 py-1 text-xs font-medium text-slate-700"
                    >
                        {{ goal }}
                    </Badge>
                </CardContent>
            </Card>
        </section>

        <section id="roles" class="space-y-3">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight">User roles</h2>
                <p class="text-sm text-muted-foreground">
                    The application is centered on three primary personas.
                </p>
            </div>

            <div class="grid gap-4 lg:grid-cols-3">
                <Card v-for="role in roles" :key="role.title" class="border-sidebar-border/70">
                    <CardHeader>
                        <CardTitle class="flex items-center justify-between text-lg">
                            <span>{{ role.title }}</span>
                            <Badge variant="outline">Role</Badge>
                        </CardTitle>
                        <CardDescription>{{ role.summary }}</CardDescription>
                    </CardHeader>
                    <CardContent class="flex flex-wrap gap-2">
                        <Badge
                            v-for="capability in role.capabilities"
                            :key="capability"
                            variant="secondary"
                            class="rounded-full"
                        >
                            {{ capability }}
                        </Badge>
                    </CardContent>
                </Card>
            </div>
        </section>

        <section id="property-types" class="grid gap-4 lg:grid-cols-[0.8fr_1.2fr]">
            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-2xl">Property types</CardTitle>
                    <CardDescription>
                        Rentora supports multiple property shapes from day one.
                    </CardDescription>
                </CardHeader>
                <CardContent class="flex flex-wrap gap-2">
                    <Badge
                        v-for="type in propertyTypes"
                        :key="type"
                        variant="outline"
                        class="rounded-full border-sidebar-border/70 px-3 py-1"
                    >
                        {{ type }}
                    </Badge>
                </CardContent>
            </Card>

            <Card class="border-sidebar-border/70">
                <CardHeader>
                    <CardTitle class="text-2xl">Product structure</CardTitle>
                    <CardDescription>
                        Every module is grouped to keep the system maintainable and future-proof.
                    </CardDescription>
                </CardHeader>
                <CardContent class="grid gap-3 sm:grid-cols-2">
                    <div class="rounded-2xl border border-sidebar-border/70 bg-muted/40 p-4">
                        <p class="text-sm font-medium">Backend shape</p>
                        <p class="mt-1 text-sm text-muted-foreground">
                            Thin controllers, service classes, form requests, policies, events, and jobs.
                        </p>
                    </div>
                    <div class="rounded-2xl border border-sidebar-border/70 bg-muted/40 p-4">
                        <p class="text-sm font-medium">Frontend shape</p>
                        <p class="mt-1 text-sm text-muted-foreground">
                            Vue 3, TypeScript, Inertia, reusable components, and strong typing everywhere.
                        </p>
                    </div>
                </CardContent>
            </Card>
        </section>

        <section id="modules" class="space-y-3">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight">Modules</h2>
                <p class="text-sm text-muted-foreground">
                    These are the product areas defined in the PRD.
                </p>
            </div>

            <div class="grid gap-4 xl:grid-cols-2">
                <Card v-for="phase in modulePhases" :key="phase.phase" class="border-sidebar-border/70">
                    <CardHeader>
                        <div class="flex flex-wrap items-center gap-2">
                            <Badge variant="outline">{{ phase.phase }}</Badge>
                            <span class="text-sm font-medium uppercase tracking-[0.2em] text-muted-foreground">
                                {{ phase.title }}
                            </span>
                        </div>
                        <CardDescription>{{ phase.description }}</CardDescription>
                    </CardHeader>
                    <CardContent class="flex flex-wrap gap-2">
                        <Badge
                            v-for="module in phase.modules"
                            :key="module"
                            variant="secondary"
                            class="rounded-full"
                        >
                            {{ module }}
                        </Badge>
                    </CardContent>
                </Card>
            </div>
        </section>

        <section id="roadmap" class="space-y-3">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight">Roadmap</h2>
                <p class="text-sm text-muted-foreground">
                    The PRD phases define the order of implementation.
                </p>
            </div>

            <div class="grid gap-4 lg:grid-cols-2 xl:grid-cols-4">
                <Card v-for="phase in modulePhases" :key="phase.title" class="border-sidebar-border/70">
                    <CardHeader>
                        <Badge variant="outline" class="w-fit">{{ phase.phase }}</Badge>
                        <CardTitle class="pt-2 text-xl">{{ phase.title }}</CardTitle>
                        <CardDescription>{{ phase.description }}</CardDescription>
                    </CardHeader>
                </Card>
            </div>
        </section>
    </div>
</template>
