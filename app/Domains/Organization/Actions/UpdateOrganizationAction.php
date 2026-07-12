<?php

namespace App\Domains\Organization\Actions;

use App\Domains\Organization\Models\Organization;
use Illuminate\Support\Facades\DB;

class UpdateOrganizationAction
{
    public function handle(Organization $organization, array $validatedData): Organization
    {
        return DB::transaction(function () use ($organization, $validatedData) {
            $organization->update($validatedData);
            return $organization->refresh();
        });
    }
}
