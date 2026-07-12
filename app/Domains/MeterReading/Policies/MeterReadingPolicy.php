<?php

namespace App\Domains\MeterReading\Policies;

use App\Domains\MeterReading\Models\MeterReading;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class MeterReadingPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, MeterReading $meterReading): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, MeterReading $meterReading): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, MeterReading $meterReading): bool
    {
        return self::isOwner($user);
    }
}
