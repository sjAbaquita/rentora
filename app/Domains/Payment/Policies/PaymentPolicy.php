<?php

namespace App\Domains\Payment\Policies;

use App\Domains\Payment\Models\Payment;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class PaymentPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Payment $payment): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function update(User $user, Payment $payment): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Payment $payment): bool
    {
        return self::isOwner($user);
    }
}
