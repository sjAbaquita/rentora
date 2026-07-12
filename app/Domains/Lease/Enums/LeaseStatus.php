<?php

namespace App\Domains\Lease\Enums;

enum LeaseStatus: string
{
    case Active = 'active';
    case Ended = 'ended';
    case Terminated = 'terminated';

    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active',
            self::Ended => 'Ended',
            self::Terminated => 'Terminated',
        };
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function options(): array
    {
        return array_map(
            fn (self $status): array => [
                'value' => $status->value,
                'label' => $status->label(),
            ],
            self::cases(),
        );
    }
}
