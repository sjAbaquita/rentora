<?php

namespace App\Domains\Property\Enums;

enum PropertyType: string
{
    case Apartment = 'apartment';
    case Building = 'building';
    case House = 'house';
    case BoardingHouse = 'boarding_house';

    public function label(): string
    {
        return match ($this) {
            self::Apartment => 'Apartment',
            self::Building => 'Building',
            self::House => 'House',
            self::BoardingHouse => 'Boarding House',
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