<?php

namespace App\Services;

use App\Models\Service;

class ServicesService
{
    /**
     * Retrieve all services from the database.
     */
    public function getAllServices()
    {
        return Service::all();
    }

    /**
     * Create a new service in the database.
     */
    public function createService(array $data, $userId='1')
    {
       
        return Service::create([
            'name' => $data['serviceName'],
            'fields' => json_encode($data['serviceFields'] ?? []),
            'added_by' => $userId,  // Dynamically use the authenticated user's ID
            'date_added' => now(),
        ]);
    }

    /**
     * Update an existing service.
     */
    public function updateService(Service $service, array $data)
    {
        $serviceData = [
            'name' => $data['serviceName'],
            'fields' => json_encode($data['serviceFields'] ?? []),
        ];

        return $service->update($serviceData);
    }

    /**
     * Delete a service.
     */
    public function deleteService(Service $service)
    {
        return $service->delete();
    }
}
