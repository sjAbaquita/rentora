<?php

namespace App\Domains\TenantPortal\Controllers;

use App\Domains\TenantPortal\Services\TenantPortalOverviewService;
use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class TenantPortalController extends Controller
{
    public function __construct(
        private readonly TenantPortalOverviewService $tenantPortalOverviewService,
    ) {
    }

    /**
     * Show the tenant portal dashboard.
     */
    public function index(): Response
    {
        $this->authorize('access', \App\Domains\TenantPortal\Services\TenantPortalOverviewService::class);

        return Inertia::render('tenant-portal/Index', $this->tenantPortalOverviewService->overview());
    }
}
