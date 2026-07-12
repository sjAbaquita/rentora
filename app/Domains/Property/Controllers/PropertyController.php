<?php

namespace App\Domains\Property\Controllers;

use App\Domains\Property\Actions\CreatePropertyAction;
use App\Domains\Property\Actions\DeletePropertyAction;
use App\Domains\Property\Actions\UpdatePropertyAction;
use App\Domains\Property\Models\Property;
use App\Domains\Property\Requests\StorePropertyRequest;
use App\Domains\Property\Requests\UpdatePropertyRequest;
use App\Domains\Property\Services\PropertyService;
use App\Http\Controllers\Controller;
use App\Http\Requests\QueryValidationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class PropertyController extends Controller
{
    public function __construct(
        private readonly PropertyService $propertyService,
    ) {
    }

    /**
     * Display a listing of properties.
     */
    public function index(QueryValidationRequest $request): Response
    {
		$this->authorize('viewAny', Property::class);

		$validated = $request->validated();
		
		$search = $validated['search'] ?? '';
    	$perPage = (int) ($validated['per_page'] ?? 10);

        return Inertia::render('properties/Index', [
			'filters' => [
				'search' => $search,
				'per_page' => $perPage,
			],

			'properties' => $this->propertyService->getProperties(
				search: $search,
				perPage: $perPage,
			),
		]);
    }

    /**
     * Show the form for creating a new property.
     */
    public function create(): Response
    {
        $this->authorize('create', Property::class);

        return Inertia::render('properties/Create');
    }

    /**
     * Store a newly created property.
     */
    public function store(StorePropertyRequest $request, CreatePropertyAction $action): RedirectResponse
    {
        $this->authorize('create', Property::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Property created.')]);

        return to_route('properties.index');
    }

    /**
     * Show the form for editing a property.
     */
    public function edit(Property $property): Response
    {
        $this->authorize('update', $property);

        return Inertia::render('properties/Edit', [
            'property' => $property,
        ]);
    }

    /**
     * Update the specified property.
     */
    public function update(Property $property, UpdatePropertyRequest $request, UpdatePropertyAction $action): RedirectResponse
    {
        $this->authorize('update', $property);

        $action->handle($property, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Property updated.')]);

        return to_route('properties.index');
    }

    /**
     * Remove the specified property.
     */
    public function destroy(Property $property, DeletePropertyAction $action): RedirectResponse
    {
        $this->authorize('delete', $property);

        $action->handle($property);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Property deleted.')]);

        return to_route('properties.index');
    }
}
