<?php

namespace App\Domains\Announcement\Actions;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Support\Facades\DB;

class UpdateAnnouncementAction
{
    public function handle(Announcement $announcement, array $validatedData): Announcement
    {
        return DB::transaction(function () use ($announcement, $validatedData) {
            $announcement->update($validatedData);
            return $announcement->refresh();
        });
    }
}
