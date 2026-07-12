<?php

namespace App\Domains\Announcement\Actions;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Support\Facades\DB;

class DeleteAnnouncementAction
{
    public function handle(Announcement $announcement): void
    {
        DB::transaction(function () use ($announcement) {
            $announcement->delete();
        });
    }
}
