<?php

namespace App\Domains\Notification\Controllers;

use App\Domains\Notification\Actions\CreateNotificationAction;
use App\Domains\Notification\Actions\DeleteNotificationAction;
use App\Domains\Notification\Actions\UpdateNotificationAction;
use App\Domains\Notification\Models\PortalNotification;
use App\Domains\Notification\Requests\StoreNotificationRequest;
use App\Domains\Notification\Requests\UpdateNotificationRequest;
use App\Domains\Notification\Services\NotificationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class NotificationController extends Controller
{
    public function __construct(
        private readonly NotificationService $notificationService,
    ) {
    }

    public function index(): Response
    {
        $this->authorize('viewAny', PortalNotification::class);

        return Inertia::render('notifications/Index', [
            'notifications' => $this->notificationService->getNotifications(),
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', PortalNotification::class);

        return Inertia::render('notifications/Create');
    }

    public function store(StoreNotificationRequest $request, CreateNotificationAction $action): RedirectResponse
    {
        $this->authorize('create', PortalNotification::class);

        $action->handle($request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Notification created.')]);

        return to_route('notifications.index');
    }

    public function edit(PortalNotification $notification): Response
    {
        $this->authorize('update', $notification);

        return Inertia::render('notifications/Edit', [
            'notification' => $notification,
        ]);
    }

    public function update(PortalNotification $notification, UpdateNotificationRequest $request, UpdateNotificationAction $action): RedirectResponse
    {
        $this->authorize('update', $notification);

        $action->handle($notification, $request->validated());

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Notification updated.')]);

        return to_route('notifications.index');
    }

    public function destroy(PortalNotification $notification, DeleteNotificationAction $action): RedirectResponse
    {
        $this->authorize('delete', $notification);

        $action->handle($notification);

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Notification deleted.')]);

        return to_route('notifications.index');
    }
}
