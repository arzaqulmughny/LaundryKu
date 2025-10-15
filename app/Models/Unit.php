<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /** @use HasFactory<\Database\Factories\UnitFactory> */
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
    ];

    /**
     * Get options for select
     */
    public static function getOptionsForSelect(): array
    {
        return self::pluck('name', 'code')->toArray();
    }
}
