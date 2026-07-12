<?php

namespace App\Domains\Tenant\Policies;

use App\Domains\Shared\Policies\BasePolicy;
use App\Domains\Tenant\Models\Tenant;
use App\Models\User;

class TenantPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Tenant $tenant): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Tenant $tenant): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Tenant $tenant): bool
    {
        return self::isOwner($user);
    }
}
