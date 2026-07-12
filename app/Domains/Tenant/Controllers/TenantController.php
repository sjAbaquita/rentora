<?php

namespace App\Domains\Tenant\Controllers;

use App\Domains\Tenant\Actions\CreateTenantAction;
use App\Domains\Tenant\Actions\DeleteTenantAction;
use App\Domains\Tenant\Actions\UpdateTenantAction;
use App\Domains\Tenant\Models\Tenant;
use App\Domains\Tenant\Requests\StoreTenantRequest;
use App\Domains\Tenant\Requests\UpdateTenantRequest;
use App\Domains\Tenant\Services\TenantService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class TenantController extends Controller
{
    public function __construct(
        private readonly TenantService $tenantService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Tenant::class);

        return Inertia::render('tenants/Index', [
            'tenants' => $this->tenantService->getTenants(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Tenant::class);

        return Inertia::render('tenants/Create');
    }

    public function store(StoreTenantRequest $request, CreateTenantAction $action): RedirectResponse
    {
        $this->authorize('create', Tenant::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Tenant created.')]);

        return to_route('tenants.index');
    }

    public function edit(Tenant $tenant): Response
    {
        $this->authorize('update', $tenant);

        return Inertia::render('tenants/Edit', [
            'tenant' => $tenant,
        ]);
    }

    public function update(Tenant $tenant, UpdateTenantRequest $request, UpdateTenantAction $action): RedirectResponse
    {
        $this->authorize('update', $tenant);

        $action->handle($tenant, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Tenant updated.')]);

        return to_route('tenants.index');
    }

    public function destroy(Tenant $tenant, DeleteTenantAction $action): RedirectResponse
    {
        $this->authorize('delete', $tenant);

        $action->handle($tenant);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Tenant deleted.')]);

        return to_route('tenants.index');
    }
}
