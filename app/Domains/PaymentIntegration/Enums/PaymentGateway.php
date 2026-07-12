<?php

namespace App\Domains\PaymentIntegration\Enums;

enum PaymentGateway: string
{
    case GCash = 'gcash';
    case Maya = 'maya';
    case Stripe = 'stripe';

    public function label(): string
    {
        return match ($this) {
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
            fn (self $gateway): array => [
                'value' => $gateway->value,
                'label' => $gateway->label(),
            ],
            self::cases(),
        );
    }
}
