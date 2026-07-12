<?php

namespace App\Domains\Announcement\Services;

use App\Domains\Announcement\Models\Announcement;
use App\Domains\Announcement\Requests\StoreAnnouncementRequest;
use App\Domains\Announcement\Requests\UpdateAnnouncementRequest;

class CreateAnnouncementService
{
    /**
     * @param StoreAnnouncementRequest $request
     * @return Announcement
     */
    public function store(StoreAnnouncementRequest $request): Announcement
    {
        return Announcement::create($request->validated());
    }

    /**
     * @param Announcement $announcement
     * @param UpdateAnnouncementRequest $request
     * @return Announcement
     */
    public function update(Announcement $announcement, UpdateAnnouncementRequest $request): Announcement
    {
        $announcement->update($request->validated());

        return $announcement;
    }

    /**
     * @param Announcement $announcement
     * @return bool|null
     */
    public function destroy(Announcement $announcement): ?bool
    {
        return $announcement->delete();
    }
}
