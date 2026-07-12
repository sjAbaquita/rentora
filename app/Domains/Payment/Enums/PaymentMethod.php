<?php

namespace App\Domains\Payment\Enums;

enum PaymentMethod: string
{
    case Cash = 'cash';
    case BankTransfer = 'bank_transfer';
    case GCash = 'gcash';
    case Maya = 'maya';
    case Stripe = 'stripe';

    public function label(): string
    {
        return match ($this) {
            self::Cash => 'Cash',
            self::BankTransfer => 'Bank Transfer',
            self::GCash => 'GCash',
            self::Maya => 'Maya',
            self::Stripe => 'Stripe',
        };
    }

    /**
     * @return array<int, array{value: string, label: string}>
     */
    public static function options(): array
    {
        return array_map(
            fn (self $method): array => [
                'value' => $method->value,
                'label' => $method->label(),
            ],
            self::cases(),
        );
    }
}