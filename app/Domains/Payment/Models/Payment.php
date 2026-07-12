<?php

namespace App\Domains\Payment\Models;

use App\Domains\Invoice\Models\Invoice;
use App\Domains\Payment\Enums\PaymentMethod;
use App\Domains\Tenant\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_id',
        'tenant_id',
        'reference_number',
        'method',
        'paid_at',
        'amount',
        'proof_status',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'method' => PaymentMethod::class,
            'paid_at' => 'datetime',
            'amount' => 'decimal:2',
        ];
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    protected static function booted(): void
    {
        static::saved(function (Payment $payment): void {
            $payment->invoice?->refresh()->reconcile();
        });

        static::deleted(function (Payment $payment): void {
            $payment->invoice?->refresh()->reconcile();
        });
    }
}