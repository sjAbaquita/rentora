<?php

namespace App\Domains\MeterReading\Enums;

enum MeterReadingType: string
{
    case Water = 'water';
    case Electricity = 'electricity';
    case Gas = 'gas';

    public function label(): string
    {
        return match ($this) {
            self::Water => 'Water',
            self::Electricity => 'Electricity',
            self::Gas => 'Gas',
        };
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function options(): array
    {
        return array_map(
            fn (self $type): array => [
                'value' => $type->value,
                'label' => $type->label(),
            ],
            self::cases(),
        );
    }
}