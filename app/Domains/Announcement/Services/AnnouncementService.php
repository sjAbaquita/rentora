<?php

namespace App\Domains\Announcement\Services;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Pagination\LengthAwarePaginator;

class AnnouncementService
{
    public function getAnnouncements(int $perPage = 15): LengthAwarePaginator
    {
        return Announcement::with('property')->latest('publish_at')->paginate($perPage);
    }

    public function getAnnouncementById(int $id): ?Announcement
    {
        return Announcement::with('property')->find($id);
    }

    public function getPublished(): LengthAwarePaginator
    {
        return Announcement::published()->latest('publish_at')->paginate(10);
    }
}
