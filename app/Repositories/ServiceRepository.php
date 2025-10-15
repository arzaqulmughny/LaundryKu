<?php

namespace App\Repositories;

use App\Models\Service;
use App\Models\ServiceMaterial;
use Illuminate\Support\Facades\DB;

class ServiceRepository
{
    /**
     * Store a new service.
     */
    public static function store(array $data): Service
    {
        try {
            DB::beginTransaction();
            // TODO: Store header
            $service = Service::create($data);

            // TODO: Store service materials
            self::upsertMaterials($service, $data['materials']);

            DB::commit();
            return $service;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Update the specified service
     */
    public static function update(Service $service, array $data): bool
    {
        $service->fill($data);
        $service->save();

        // TODO: Update service materials
        self::upsertMaterials($service->fresh(), $data['materials']);

        return true;
    }

    /**
     * Upsert material services
     */
    public static function upsertMaterials(Service $service, array $materials)
    {
        $ids = [];

        collect($materials)->each(function ($material) use ($service, &$ids) {
            $data = array_merge($material, ['service_id' => $service->id]);

            if (empty($material['id'])) {
                // create new record
                $record = ServiceMaterial::create($data);
                $ids[] = $record->id;
            } else {
                // update existing record
                $record = ServiceMaterial::find($material['id']);
                if ($record) {
                    $record->update($data);
                    $ids[] = $record->id;
                }
            }
        });

        // delete materials not in current list
        ServiceMaterial::where('service_id', $service->id)
            ->whereNotIn('id', $ids)
            ->delete();
    }


    /**
     * Delete the specified service
     */
    public static function delete(Service $service): bool
    {
        // TODO: Delete service materials
        $service->materials()->delete();
        return $service->delete();
    }
}
