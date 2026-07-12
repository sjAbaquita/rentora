<?php

namespace App\Domains\Invoice\Models;

use App\Domains\Invoice\Enums\InvoiceStatus;
use App\Domains\Lease\Models\Lease;
use App\Domains\Payment\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    /** @use HasFactory<\Database\Factories\InvoiceFactory> */
    use HasFactory;

    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'lease_id',
        'invoice_number',
        'billing_period',
        'due_date',
        'amount_due',
        'amount_paid',
        'late_fee',
        'status',
        'description',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'due_date' => 'date',
            'amount_due' => 'decimal:2',
            'amount_paid' => 'decimal:2',
            'late_fee' => 'decimal:2',
            'status' => InvoiceStatus::class,
        ];
    }

    public function lease(): BelongsTo
    {
        return $this->belongsTo(Lease::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function balance(): float
    {
        return (float) $this->amount_due + (float) $this->late_fee - (float) $this->amount_paid;
    }

    public function isPaid(): bool
    {
        return $this->status === InvoiceStatus::Paid || $this->balance() <= 0;
    }

    public function markPaid(): void
    {
        $this->status = InvoiceStatus::Paid;
        $this->save();
    }

    public function markOverdue(): void
    {
        if (! $this->isPaid() && $this->due_date->isPast()) {
            $this->status = InvoiceStatus::Overdue;
            $this->save();
        }
    }

    public function reconcile(): void
    {
        $this->amount_paid = $this->payments()->sum('amount');

        if ($this->amount_paid <= 0) {
            $this->status = $this->due_date->isPast() ? InvoiceStatus::Overdue : InvoiceStatus::Pending;
        } elseif ($this->amount_paid >= ((float) $this->amount_due + (float) $this->late_fee)) {
            $this->status = InvoiceStatus::Paid;
        } else {
            $this->status = InvoiceStatus::Partial;
        }

        $this->save();
    }
}