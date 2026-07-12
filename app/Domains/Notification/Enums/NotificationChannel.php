<?php

namespace App\Domains\Notification\Enums;

enum NotificationChannel: string
{
    case Email = 'email';
    case Database = 'database';
    case Sms = 'sms';

    public function label(): string
    {
        return match ($this) {
            self::Email => 'Email',
            self::Database => 'Database',
            self::Sms => 'SMS',
        };
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function options(): array
    {
        return array_map(
            fn (self $channel): array => [
                'value' => $channel->value,
                'label' => $channel->label(),
            ],
            self::cases(),
        );
    }
}