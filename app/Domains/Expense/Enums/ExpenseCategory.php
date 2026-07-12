<?php

namespace App\Domains\Expense\Enums;

enum ExpenseCategory: string
{
    case Utilities = 'utilities';
    case Repairs = 'repairs';
    case Supplies = 'supplies';
    case Administration = 'administration';
    case Security = 'security';

    public function label(): string
    {
        return match ($this) {
            self::Utilities => 'Utilities',
            self::Repairs => 'Repairs',
            self::Supplies => 'Supplies',
            self::Administration => 'Administration',
            self::Security => 'Security',
        };
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function options(): array
    {
        return array_map(
            fn (self $category): array => [
                'value' => $category->value,
                'label' => $category->label(),
            ],
            self::cases(),
        );
    }
}