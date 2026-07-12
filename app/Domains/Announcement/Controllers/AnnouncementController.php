<?php

namespace App\Domains\Announcement\Controllers;

use App\Domains\Announcement\Actions\CreateAnnouncementAction;
use App\Domains\Announcement\Actions\DeleteAnnouncementAction;
use App\Domains\Announcement\Actions\UpdateAnnouncementAction;
use App\Domains\Announcement\Models\Announcement;
use App\Domains\Announcement\Requests\StoreAnnouncementRequest;
use App\Domains\Announcement\Requests\UpdateAnnouncementRequest;
use App\Domains\Announcement\Services\AnnouncementService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class AnnouncementController extends Controller
{
    public function __construct(
        private readonly AnnouncementService $announcementService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', Announcement::class);

        return Inertia::render('announcements/Index', [
            'announcements' => $this->announcementService->getAnnouncements(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Announcement::class);

        return Inertia::render('announcements/Create');
    }

    public function store(StoreAnnouncementRequest $request, CreateAnnouncementAction $action): RedirectResponse
    {
        $this->authorize('create', Announcement::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Announcement created.')]);

        return to_route('announcements.index');
    }

    public function edit(Announcement $announcement): Response
    {
        $this->authorize('update', $announcement);

        return Inertia::render('announcements/Edit', [
            'announcement' => $announcement,
        ]);
    }

    public function update(Announcement $announcement, UpdateAnnouncementRequest $request, UpdateAnnouncementAction $action): RedirectResponse
    {
        $this->authorize('update', $announcement);

        $action->handle($announcement, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Announcement updated.')]);

        return to_route('announcements.index');
    }

    public function destroy(Announcement $announcement, DeleteAnnouncementAction $action): RedirectResponse
    {
        $this->authorize('delete', $announcement);

        $action->handle($announcement);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Announcement deleted.')]);

        return to_route('announcements.index');
    }
}
