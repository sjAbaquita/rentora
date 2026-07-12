<?php

namespace App\Domains\TenantPortal\Policies;

use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class TenantPortalPolicy extends BasePolicy
{
    public function access(User $user): bool
    {
        return self::isTenant($user) || self::isOwner($user);
    }
}
