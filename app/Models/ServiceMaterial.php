<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceMaterial extends Model
{
    protected $table = 'service_materials';

    protected $fillable = [
        'service_id',
        'material_id',
        'quantity',
    ];

    protected $appends = [
        'name',
        'unit',
    ];

    /**
     * Define many-to-one relationship with materials table
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    /**
     * Define many-to-one relationship with services table
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Get name attribute
     */
    public function getNameAttribute()
    {
        return $this->material->name;
    }

    /**
     * Get unit attribute
     */
    public function getUnitAttribute()
    {
        return $this->material->unit;
    }
}
