<?php

namespace App\Domains\Document\Enums;

enum DocumentType: string
{
    case Lease = 'lease';
    case Receipt = 'receipt';
    case Identification = 'identification';
    case Permit = 'permit';
    case MaintenanceReport = 'maintenance_report';

    public function label(): string
    {
        return match ($this) {
            self::Lease => 'Lease',
            self::Receipt => 'Receipt',
            self::Identification => 'Identification',
            self::Permit => 'Permit',
            self::MaintenanceReport => 'Maintenance Report',
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