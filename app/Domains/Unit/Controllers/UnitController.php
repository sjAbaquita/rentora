<?php

namespace App\Domains\Unit\Controllers;

use App\Domains\Unit\Actions\CreateUnitAction;
use App\Domains\Unit\Actions\DeleteUnitAction;
use App\Domains\Unit\Actions\UpdateUnitAction;
use App\Domains\Unit\Models\Unit;
use App\Domains\Unit\Requests\StoreUnitRequest;
use App\Domains\Unit\Requests\UpdateUnitRequest;
use App\Domains\Unit\Services\UnitService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class UnitController extends Controller
{
    public function __construct(
        private readonly UnitService $unitService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Unit::class);

        return Inertia::render('units/Index', [
            'units' => $this->unitService->getUnits(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Unit::class);

        $properties = \App\Domains\Property\Models\Property::select('id', 'name')
            ->get()
            ->map(fn($p) => ['id' => $p->id, 'label' => "{$p->name} (ID: {$p->id})"])
            ->toArray();

        return Inertia::render('units/Create', [
            'properties' => $properties,
        ]);
    }

    public function store(StoreUnitRequest $request, CreateUnitAction $action): RedirectResponse
    {
        $this->authorize('create', Unit::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Unit created.')]);

        return to_route('units.index');
    }

    public function edit(Unit $unit): Response
    {
        $this->authorize('update', $unit);

        $properties = \App\Domains\Property\Models\Property::select('id', 'name')
            ->get()
            ->map(fn($p) => ['id' => $p->id, 'label' => "{$p->name} (ID: {$p->id})"])
            ->toArray();

        return Inertia::render('units/Edit', [
            'unit' => $unit,
            'properties' => $properties,
        ]);
    }

    public function update(Unit $unit, UpdateUnitRequest $request, UpdateUnitAction $action): RedirectResponse
    {
        $this->authorize('update', $unit);

        $action->handle($unit, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Unit updated.')]);

        return to_route('units.index');
    }

    public function destroy(Unit $unit, DeleteUnitAction $action): RedirectResponse
    {
        $this->authorize('delete', $unit);

        $action->handle($unit);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Unit deleted.')]);

        return to_route('units.index');
    }
}
