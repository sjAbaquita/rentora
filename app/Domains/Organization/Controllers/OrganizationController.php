<?php

namespace App\Domains\Organization\Controllers;

use App\Domains\Organization\Actions\CreateOrganizationAction;
use App\Domains\Organization\Actions\DeleteOrganizationAction;
use App\Domains\Organization\Actions\UpdateOrganizationAction;
use App\Domains\Organization\Models\Organization;
use App\Domains\Organization\Requests\StoreOrganizationRequest;
use App\Domains\Organization\Requests\UpdateOrganizationRequest;
use App\Domains\Organization\Services\OrganizationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class OrganizationController extends Controller
{
    public function __construct(
        private readonly OrganizationService $organizationService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Organization::class);

        return Inertia::render('organization/Index', [
            'organizations' => $this->organizationService->getOrganizations(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Organization::class);

        return Inertia::render('organization/Create');
    }

    public function store(StoreOrganizationRequest $request, CreateOrganizationAction $action): RedirectResponse
    {
        $this->authorize('create', Organization::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Organization created.')]);

        return to_route('organization.index');
    }

    public function edit(Organization $organization): Response
    {
        $this->authorize('update', $organization);

        return Inertia::render('organization/Edit', [
            'organization' => $organization,
        ]);
    }

    public function update(Organization $organization, UpdateOrganizationRequest $request, UpdateOrganizationAction $action): RedirectResponse
    {
        $this->authorize('update', $organization);

        $action->handle($organization, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Organization updated.')]);

        return to_route('organization.index');
    }

    public function destroy(Organization $organization, DeleteOrganizationAction $action): RedirectResponse
    {
        $this->authorize('delete', $organization);

        $action->handle($organization);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Organization deleted.')]);

        return to_route('organization.index');
    }
}
