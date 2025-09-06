<?php

namespace App\Repositories;

use App\Models\Service;

class ServiceRepository
{
    /**
     * Store a new service.
     */
    public static function store(array $data): Service
    {
        return Service::create($data);
    }

    /**
     * Update the specified service
     */
    public static function update(Service $service, array $data): bool
    {
        $service->fill($data);
        $service->save();

        return true;
    }

    /**
     * Delete the specified service
     */
    public static function delete(Service $service): bool
    {
        return $service->delete();
    }
}
