<?php

namespace App\Repositories;

use App\Classes\ApiResponseHelper;
use App\Interfaces\VehicleRepositoryInterface;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function getAll()
    {
        return Vehicle::with('owner', 'driver')->get();
    }

    public function getById($id)
    {
        try {

            return Vehicle::findOrFail($id);

        } catch(ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex->getMessage(), 'Not found', 404);
        } catch(\Throwable $th) {
            return ApiResponseHelper::throw($th->getMessage(), 'Internal error', 500);
        }
    }

    public function store(array $data)
    {
        return Vehicle::create($data);
    }

    public function update(array $data, $id)
    {
        try {

            $driver = Vehicle::findOrFail($id);
            return $driver->update($data);

        } catch(ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex->getMessage(), 'Not found', 404);
        } catch(\Throwable $th) {
            return ApiResponseHelper::throw($th->getMessage(), 'Internal error', 500);
        }
    }
}
