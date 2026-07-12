<?php

namespace App\Domains\MeterReading\Controllers;

use App\Domains\MeterReading\Actions\CreateMeterReadingAction;
use App\Domains\MeterReading\Actions\DeleteMeterReadingAction;
use App\Domains\MeterReading\Actions\UpdateMeterReadingAction;
use App\Domains\MeterReading\Models\MeterReading;
use App\Domains\MeterReading\Requests\StoreMeterReadingRequest;
use App\Domains\MeterReading\Requests\UpdateMeterReadingRequest;
use App\Domains\MeterReading\Services\MeterReadingService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class MeterReadingController extends Controller
{
    public function __construct(
        private readonly MeterReadingService $meterReadingService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', MeterReading::class);

        return Inertia::render('meter-readings/Index', [
            'meterReadings' => $this->meterReadingService->getMeterReadings(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', MeterReading::class);

        return Inertia::render('meter-readings/Create');
    }

    public function store(StoreMeterReadingRequest $request, CreateMeterReadingAction $action): RedirectResponse
    {
        $this->authorize('create', MeterReading::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Meter reading created.')]);

        return to_route('meter-readings.index');
    }

    public function edit(MeterReading $meterReading): Response
    {
        $this->authorize('update', $meterReading);

        return Inertia::render('meter-readings/Edit', [
            'meterReading' => $meterReading,
        ]);
    }

    public function update(MeterReading $meterReading, UpdateMeterReadingRequest $request, UpdateMeterReadingAction $action): RedirectResponse
    {
        $this->authorize('update', $meterReading);

        $action->handle($meterReading, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Meter reading updated.')]);

        return to_route('meter-readings.index');
    }

    public function destroy(MeterReading $meterReading, DeleteMeterReadingAction $action): RedirectResponse
    {
        $this->authorize('delete', $meterReading);

        $action->handle($meterReading);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Meter reading deleted.')]);

        return to_route('meter-readings.index');
    }
}
