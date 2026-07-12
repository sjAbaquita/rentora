<?php

namespace App\Domains\Invoice\Policies;

use App\Domains\Invoice\Models\Invoice;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class InvoicePolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Invoice $invoice): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Invoice $invoice): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Invoice $invoice): bool
    {
        return self::isOwner($user);
    }
}
