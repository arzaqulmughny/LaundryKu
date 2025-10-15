<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'active',
        'unit',
        'pricing_mode',
        'labor_cost',
    ];

    /**
     * Get pricing mode enum
     */
    public static array $pricingModeEnum = [
        'FIXED' => 'Tetap',
        'MARKUP_PERCENTAGE' => 'Kenaikan Persentase',
        'MARKUP_AMOUNT' => 'Kenaikan Nominal',
    ];

    /**
     * Define 1-to-many relationship with service materials table
     */
    public function materials()
    {
        return $this->hasMany(ServiceMaterial::class);
    }
}
