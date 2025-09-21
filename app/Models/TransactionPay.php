<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class TransactionPay extends Model
{
    protected $fillable = [
        'amount',
        'transaction_id',
        'created_by',
        'date'
    ];

    /**
     * Define 1-1 relation for user
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Declare closure event for this model
     */
    protected static function booted(): void
    {
        static::creating(fn(TransactionPay $transactionPay) => $transactionPay->created_by = Auth::id() ?? 0);
    }
}
