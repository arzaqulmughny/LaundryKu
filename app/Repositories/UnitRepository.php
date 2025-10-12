<?php

namespace App\Repositories;

use App\Http\Resources\UnitResource;
use App\Models\Customer;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class UnitRepository
{
    /**
     * Store a new customer.
     */
    public static function store(array $data): Unit
    {
        return Unit::create($data);
    }

    /**
     * Update the specified unit
     */
    public static function update(Unit $unit, array $data): bool
    {
        $unit->fill($data);
        $unit->save();

        return true;
    }

    /**
     * Delete the specified unit
     */
    public static function delete(Unit $unit): bool
    {
        return $unit->delete();
    }

    /**
     * Get all units
     */
    public static function all()
    {
        return UnitResource::collection(Unit::all());
    }
}
