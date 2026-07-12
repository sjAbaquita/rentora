<?php

namespace App\Domains\Lease\Controllers;

use App\Domains\Lease\Actions\CreateLeaseAction;
use App\Domains\Lease\Actions\DeleteLeaseAction;
use App\Domains\Lease\Actions\UpdateLeaseAction;
use App\Domains\Lease\Models\Lease;
use App\Domains\Lease\Requests\StoreLeaseRequest;
use App\Domains\Lease\Requests\UpdateLeaseRequest;
use App\Domains\Lease\Services\LeaseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class LeaseController extends Controller
{
    public function __construct(
        private readonly LeaseService $leaseService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Lease::class);

        return Inertia::render('leases/Index', [
            'leases' => $this->leaseService->getLeases(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Lease::class);

        $units = \App\Domains\Unit\Models\Unit::select('id', 'unit_number', 'property_id')
            ->with('property')
            ->get()
            ->map(fn($u) => ['id' => $u->id, 'label' => $u->unit_number . ' - Property: ' . ($u->property?->name ?? 'N/A')])
            ->toArray();

        $tenants = \App\Domains\Tenant\Models\Tenant::select('id', 'first_name', 'last_name', 'email')
            ->get()
            ->map(fn($t) => ['id' => $t->id, 'label' => "{$t->first_name} {$t->last_name} ({$t->email})"])
            ->toArray();

        return Inertia::render('leases/Create', [
            'units' => $units,
            'tenants' => $tenants,
        ]);
    }

    public function store(StoreLeaseRequest $request, CreateLeaseAction $action): RedirectResponse
    {
        $this->authorize('create', Lease::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Lease created.')]);

        return to_route('leases.index');
    }

    public function edit(Lease $lease): Response
    {
        $this->authorize('update', $lease);

        $units = \App\Domains\Unit\Models\Unit::select('id', 'unit_number', 'property_id')
            ->with('property')
            ->get()
            ->map(fn($u) => ['id' => $u->id, 'label' => $u->unit_number . ' - Property: ' . ($u->property?->name ?? 'N/A')])
            ->toArray();

        $tenants = \App\Domains\Tenant\Models\Tenant::select('id', 'first_name', 'last_name', 'email')
            ->get()
            ->map(fn($t) => ['id' => $t->id, 'label' => "{$t->first_name} {$t->last_name} ({$t->email})"])
            ->toArray();

        return Inertia::render('leases/Edit', [
            'lease' => $lease,
            'units' => $units,
            'tenants' => $tenants,
        ]);
    }

    public function update(Lease $lease, UpdateLeaseRequest $request, UpdateLeaseAction $action): RedirectResponse
    {
        $this->authorize('update', $lease);

        $action->handle($lease, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Lease updated.')]);

        return to_route('leases.index');
    }

    public function destroy(Lease $lease, DeleteLeaseAction $action): RedirectResponse
    {
        $this->authorize('delete', $lease);

        $action->handle($lease);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Lease deleted.')]);

        return to_route('leases.index');
    }
}
