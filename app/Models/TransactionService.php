<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionService extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'transaction_id',
        'service_id',
        'service_name',
        'service_unit',
        'service_price',
        'quantity',
        'total'
    ];
}
