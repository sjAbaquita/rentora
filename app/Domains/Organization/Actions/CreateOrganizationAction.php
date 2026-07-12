<?php

namespace App\Domains\Organization\Actions;

use App\Domains\Organization\Models\Organization;
use Illuminate\Support\Facades\DB;

class CreateOrganizationAction
{
    public function handle(array $validatedData): Organization
    {
        return DB::transaction(function () use ($validatedData) {
            return Organization::create($validatedData);
        });
    }
}
