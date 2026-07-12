<?php

namespace App\Domains\Expense\Policies;

use App\Domains\Expense\Models\Expense;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class ExpensePolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Expense $expense): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Expense $expense): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Expense $expense): bool
    {
        return self::isOwner($user);
    }
}
