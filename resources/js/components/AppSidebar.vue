<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Bell, CircleDollarSign, FileText, Home, LayoutGrid, Megaphone, SquareStack, Users, Wallet, Wrench } from '@lucide/vue';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
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
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Properties',
        href: properties.index().url,
        icon: Home,
    },
    {
        title: 'Tenants',
        href: tenants.index().url,
        icon: Users,
    },
    {
        title: 'Units',
        href: units.index().url,
        icon: SquareStack,
    },
    {
        title: 'Leases',
        href: leases.index().url,
        icon: FileText,
    },
    {
        title: 'Invoices',
        href: invoices.index().url,
        icon: CircleDollarSign,
    },
    {
        title: 'Payments',
        href: payments.index().url,
        icon: CircleDollarSign,
    },
    {
        title: 'Maintenance',
        href: maintenance.index().url,
        icon: Wrench,
    },
    {
        title: 'Expenses',
        href: expenses.index().url,
        icon: Wallet,
    },
    {
        title: 'Announcements',
        href: announcements.index().url,
        icon: Megaphone,
    },
    {
        title: 'Documents',
        href: documents.index().url,
        icon: FileText,
    },
    {
        title: 'Reports',
        href: reports.index().url,
        icon: FileText,
    },
    {
        title: 'Meter Readings',
        href: meterReadings.index().url,
        icon: FileText,
    },
    {
        title: 'Notifications',
        href: notifications.index().url,
        icon: Bell,
    },
    {
        title: 'Tenant Portal',
        href: tenantPortal.index().url,
        icon: Users,
    },
    {
        title: 'Payment Integrations',
        href: paymentIntegrations.index().url,
        icon: Wallet,
    },
    {
        title: 'Organization',
        href: organization.index().url,
        icon: Users,
    },
];

const footerNavItems: NavItem[] = [];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
