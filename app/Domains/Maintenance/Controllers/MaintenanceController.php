<?php

namespace App\Domains\Maintenance\Controllers;

use App\Domains\Maintenance\Actions\CreateMaintenanceAction;
use App\Domains\Maintenance\Actions\DeleteMaintenanceAction;
use App\Domains\Maintenance\Actions\UpdateMaintenanceAction;
use App\Domains\Maintenance\Models\MaintenanceRequest;
use App\Domains\Maintenance\Requests\StoreMaintenanceRequest;
use App\Domains\Maintenance\Requests\UpdateMaintenanceRequest;
use App\Domains\Maintenance\Services\MaintenanceService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MaintenanceController extends Controller
{
    public function __construct(
        private readonly MaintenanceService $maintenanceService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', MaintenanceRequest::class);

        return Inertia::render('maintenance/Index', [
            'maintenances' => $this->maintenanceService->getMaintenances(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', MaintenanceRequest::class);

        return Inertia::render('maintenance/Create');
    }

    public function store(StoreMaintenanceRequest $request, CreateMaintenanceAction $action): RedirectResponse
    {
        $this->authorize('create', MaintenanceRequest::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Maintenance created.')]);

        return to_route('maintenance.index');
    }

    public function edit(MaintenanceRequest $maintenance): Response
    {
        $this->authorize('update', $maintenance);

        return Inertia::render('maintenance/Edit', [
            'maintenance' => $maintenance,
        ]);
    }

    public function update(MaintenanceRequest $maintenance, UpdateMaintenanceRequest $request, UpdateMaintenanceAction $action): RedirectResponse
    {
        $this->authorize('update', $maintenance);

        $action->handle($maintenance, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Maintenance updated.')]);

        return to_route('maintenance.index');
    }

    public function destroy(MaintenanceRequest $maintenance, DeleteMaintenanceAction $action): RedirectResponse
    {
        $this->authorize('delete', $maintenance);

        $action->handle($maintenance);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Maintenance deleted.')]);

        return to_route('maintenance.index');
    }
}
