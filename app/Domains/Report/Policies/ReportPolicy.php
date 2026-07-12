<?php

namespace App\Domains\Report\Policies;

use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class ReportPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }
}
