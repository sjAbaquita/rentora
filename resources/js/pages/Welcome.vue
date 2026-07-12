<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { dashboard, login, register } from '@/routes';
</script>

<template>
    <Head title="Rentora" />

    <div class="min-h-screen bg-[radial-gradient(circle_at_top,rgba(16,185,129,0.16),transparent_35%),linear-gradient(180deg,#f8fafc_0%,#eef2f7_100%)] text-slate-950">
        <div class="mx-auto flex min-h-screen w-full max-w-7xl flex-col px-6 py-6 lg:justify-center lg:px-8">
            <header class="flex flex-col gap-4 border-b border-slate-200/80 pb-6 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.35em] text-emerald-700">Rentora</p>
                    <h1 class="mt-2 text-2xl font-semibold tracking-tight sm:text-3xl">
                        Property management built for landlords, lessors, and tenants.
                    </h1>
                </div>

                <nav class="flex flex-wrap items-center gap-3">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="dashboard()"
                        class="inline-flex items-center justify-center rounded-md bg-slate-950 px-4 py-2 text-sm font-medium text-white transition hover:bg-slate-800"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="login()"
                            class="inline-flex items-center justify-center rounded-md border border-slate-300 bg-white px-4 py-2 text-sm font-medium text-slate-950 transition hover:border-slate-400"
                        >
                            Log in
                        </Link>
                        <Link
                            :href="register()"
                            class="inline-flex items-center justify-center rounded-md bg-emerald-700 px-4 py-2 text-sm font-medium text-white transition hover:bg-emerald-600"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </header>

            <main class="grid flex-1 items-center gap-6 py-10 lg:grid-cols-[1.25fr_0.75fr] lg:py-14">
                <section class="space-y-6">
                    <div class="space-y-4">
                        <p class="inline-flex w-fit items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1 text-xs font-medium uppercase tracking-[0.25em] text-emerald-800">
                            Modular, maintainable, SaaS-ready
                        </p>
                        <h2 class="max-w-3xl text-4xl font-semibold tracking-tight text-slate-950 sm:text-5xl">
                            Manage properties, units, billing, and service requests in one domain-driven system.
                        </h2>
                        <p class="max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
                            Rentora is designed for the full property lifecycle: setup your portfolio,
                            manage tenant relationships, collect rent, record payments, track maintenance,
                            and prepare for future SaaS expansion.
                        </p>
                    </div>

                    <div class="grid gap-3 sm:grid-cols-2 xl:grid-cols-4">
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <p class="text-sm text-slate-500">Roles</p>
                            <p class="mt-1 text-xl font-semibold">Owner, Tenant, Staff</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <p class="text-sm text-slate-500">Property types</p>
                            <p class="mt-1 text-xl font-semibold">Apartment, Building, House, Boarding House</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <p class="text-sm text-slate-500">Modules</p>
                            <p class="mt-1 text-xl font-semibold">Authentication to Reports</p>
                        </div>
                        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                            <p class="text-sm text-slate-500">Direction</p>
                            <p class="mt-1 text-xl font-semibold">Future SaaS platform</p>
                        </div>
                    </div>
                </section>

                <aside class="space-y-4 rounded-3xl border border-slate-200 bg-slate-950 p-6 text-white shadow-2xl shadow-slate-950/15">
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-[0.3em] text-emerald-300">Product focus</p>
                        <h3 class="text-2xl font-semibold">Phase 1 starts with the core operating system.</h3>
                        <p class="text-sm leading-6 text-slate-300">
                            Authentication, dashboard, property management, units, tenants, leases,
                            invoices, payment recording, and the tenant portal are the first delivery slice.
                        </p>
                    </div>

                    <div class="space-y-3 text-sm text-slate-200">
                        <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="mt-1 h-2 w-2 rounded-full bg-emerald-300" />
                            <div>
                                <p class="font-medium text-white">Domain-driven structure</p>
                                <p class="mt-1 text-slate-300">Each module keeps its own business rules and presentation concerns isolated.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 rounded-2xl border border-white/10 bg-white/5 p-4">
                            <div class="mt-1 h-2 w-2 rounded-full bg-amber-300" />
                            <div>
                                <p class="font-medium text-white">Reusable UI</p>
                                <p class="mt-1 text-slate-300">Shared components and typed props keep the frontend maintainable.</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </main>
        </div>
    </div>
</template>