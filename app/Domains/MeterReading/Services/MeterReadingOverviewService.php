<?php

namespace App\Domains\MeterReading\Services;

use App\Domains\MeterReading\Enums\MeterReadingType;

class MeterReadingOverviewService
{
    /**
     * @return array{
     *     summaryCards: array<int, array{label: string, value: string, detail: string}>,
     *     readingTypes: array<int, array{value: string, label: string}>,
     *     readings: array<int, array{
     *         reading_type: string,
     *         property_name: string,
     *         unit_name: string,
     *         previous_reading: string,
     *         current_reading: string,
     *         recorded_at: string,
     *     }>,
     *     nextSteps: array<int, string>
     * }
     */
    public function overview(): array
    {
        return [
            'summaryCards' => [
                [
                    'label' => 'Recorded readings',
                    'value' => '64',
                    'detail' => 'Logged across water, electric, and gas meters',
                ],
                [
                    'label' => 'Current month',
                    'value' => '18',
                    'detail' => 'Reading entries captured this month',
                ],
                [
                    'label' => 'Properties covered',
                    'value' => '11',
                    'detail' => 'Buildings and units currently monitored',
                ],
                [
                    'label' => 'Variance alerts',
                    'value' => '4',
                    'detail' => 'Potential spikes flagged for review',
                ],
            ],
            'readingTypes' => MeterReadingType::options(),
            'readings' => [
                [
                    'reading_type' => MeterReadingType::Water->label(),
                    'property_name' => 'Aurora Residences',
                    'unit_name' => 'Unit 4B',
                    'previous_reading' => '218.4',
                    'current_reading' => '229.1',
                    'recorded_at' => '2026-06-20 07:30',
                ],
                [
                    'reading_type' => MeterReadingType::Electricity->label(),
                    'property_name' => 'North Gate Building',
                    'unit_name' => 'Unit 2A',
                    'previous_reading' => '4120',
                    'current_reading' => '4288',
                    'recorded_at' => '2026-06-19 18:10',
                ],
                [
                    'reading_type' => MeterReadingType::Gas->label(),
                    'property_name' => 'South Annex',
                    'unit_name' => 'Unit 1C',
                    'previous_reading' => '102.6',
                    'current_reading' => '109.8',
                    'recorded_at' => '2026-06-18 09:05',
                ],
                [
                    'reading_type' => MeterReadingType::Water->label(),
                    'property_name' => 'West View Homes',
                    'unit_name' => 'Unit 3D',
                    'previous_reading' => '145.2',
                    'current_reading' => '152.9',
                    'recorded_at' => '2026-06-17 16:40',
                ],
            ],
            'nextSteps' => [
                'Build a meter reading form for manual and imported entries.',
                'Compare current readings against previous month values.',
                'Trigger consumption estimates for invoice preparation.',
                'Add anomaly alerts when usage changes sharply.',
            ],
        ];
    }
}