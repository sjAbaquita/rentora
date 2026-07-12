<?php

namespace App\Domains\Maintenance\Policies;

use App\Domains\Maintenance\Models\MaintenanceRequest;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class MaintenancePolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, MaintenanceRequest $maintenanceRequest): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function update(User $user, MaintenanceRequest $maintenanceRequest): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function delete(User $user, MaintenanceRequest $maintenanceRequest): bool
    {
        return self::isOwner($user);
    }
}
