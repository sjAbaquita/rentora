<?php

namespace App\Domains\Property\Policies;

use App\Domains\Property\Models\Property;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class PropertyPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Property $property): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Property $property): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Property $property): bool
    {
        return self::isOwner($user);
    }
}
