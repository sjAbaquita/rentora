<?php

namespace App\Domains\Lease\Policies;

use App\Domains\Lease\Models\Lease;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class LeasePolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Lease $lease): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Lease $lease): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Lease $lease): bool
    {
        return self::isOwner($user);
    }
}
