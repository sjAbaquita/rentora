<?php

namespace App\Domains\Organization\Actions;

use App\Domains\Organization\Models\Organization;
use Illuminate\Support\Facades\DB;

class DeleteOrganizationAction
{
    public function handle(Organization $organization): void
    {
        DB::transaction(function () use ($organization) {
            $organization->delete();
        });
    }
}
