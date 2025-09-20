<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'due_date',
        'status',
        'attachment',
        'total',
        'customer_id',
        'created_by',
        'payment_status',
        'total_paid',
    ];

    protected $appends = ['status_label', 'payment_status_label', 'formatted_due_date', 'formatted_date'];

    /**
     * Define one-to-many relationship with transaction services
     */
    public function services()
    {
        return $this->hasMany(TransactionService::class, 'transaction_id');
    }

    /**
     * Define 1-1 relationship for customer
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    /**
     * Define 1-1 relationship for staff
     */
    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    /**
     * Transaction status enum
     */
    public static $statusEnums = [
        0 => 'Dalam Antrian',
        1 => 'Sedang Diproses',
        2 => 'Siap diambil',
        3 => 'Selesai'
    ];

    /**
     * Get status_label attribute
     */
    public function getStatusLabelAttribute()
    {
        return self::$statusEnums[$this->status] ?? '';
    }
    
    /**
     * Payment status enum
     */
    public static $paymentStatusEnum = [
        0 => 'Lunas',
        1 => 'Uang Muka',
        2 => 'Bayar Nanti',
    ];

    /**
     * Get payment_status_label attribute
     */
    public function getPaymentStatusLabelAttribute()
    {
        return self::$paymentStatusEnum[$this->payment_status] ?? '';
    }

    /**
     * Declare closure event for this model
     */
    protected static function booted(): void
    {
        static::creating(fn (Transaction $transaction) => $transaction->created_by = Auth::id());
    }

    /**
     * Get formmated due_date attribute
     */
    public function getFormattedDueDateAttribute()
    {
        return Carbon::parse($this->due_date)->format('d-m-Y');
    }

    /**
     * Get formatted date attribute
     */
    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d-m-Y');
    }
}
