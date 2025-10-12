<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Models\Material;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class MaterialRepository
{
    /**
     * Store a new material.
     */
    public static function store(array $data): Material
    {
        return Material::create($data);
    }

    /**
     * Update the specified material
     */
    public static function update(Material $material, array $data): bool
    {
        $material->fill($data);
        $material->save();

        return true;
    }

    /**
     * Delete the specified material
     */
    public static function delete(Material $material): bool
    {
        return $material->delete();
    }
}
