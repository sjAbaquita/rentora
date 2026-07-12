<?php

namespace App\Domains\Announcement\Actions;

use App\Domains\Announcement\Models\Announcement;
use Illuminate\Support\Facades\DB;

class CreateAnnouncementAction
{
    public function handle(array $validatedData): Announcement
    {
        return DB::transaction(function () use ($validatedData) {
            return Announcement::create($validatedData);
        });
    }
}
