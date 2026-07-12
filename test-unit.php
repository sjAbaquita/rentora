<?php
require 'bootstrap/app.php';

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$unit = \App\Domains\Unit\Models\Unit::with('property')->first();

if ($unit) {
    echo "Unit ID: " . $unit->id . "\n";
    echo "Unit number: " . $unit->unit_number . "\n";
    echo "Property ID: " . ($unit->property_id ?? 'NULL') . "\n";
    echo "Property name: " . ($unit->property?->name ?? 'NULL') . "\n";
    echo "Property loaded: " . ($unit->relationLoaded('property') ? 'YES' : 'NO') . "\n";
} else {
    echo "No units found\n";
}
