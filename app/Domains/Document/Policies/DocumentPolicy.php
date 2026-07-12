<?php

namespace App\Domains\Document\Policies;

use App\Domains\Document\Models\Document;
use App\Domains\Shared\Policies\BasePolicy;
use App\Models\User;

class DocumentPolicy extends BasePolicy
{
    public function viewAny(User $user): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function view(User $user, Document $document): bool
    {
        return self::isStaffOrOwner($user);
    }

    public function create(User $user): bool
    {
        return self::isOwner($user);
    }

    public function update(User $user, Document $document): bool
    {
        return self::isOwner($user);
    }

    public function delete(User $user, Document $document): bool
    {
        return self::isOwner($user);
    }
}
