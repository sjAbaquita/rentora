<?php

namespace App\Domains\Organization\Policies;

use App\Domains\Organization\Models\Organization;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class OrganizationPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isOwner($user);
    }

    public function view(User $user, Organization $organization): bool
    {
        return self::isOwner($user) && $user->organization_id === $organization->id;
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Organization $organization): bool
    {
        return self::isOwner($user) && $user->organization_id === $organization->id;
    }

    public function delete(User $user, Organization $organization): bool
    {
        return self::isOwner($user) && $user->organization_id === $organization->id;
    }
}
