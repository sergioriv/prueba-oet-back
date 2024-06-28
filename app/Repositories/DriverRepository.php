<?php

namespace App\Repositories;

use App\Classes\ApiResponseHelper;
use App\Interfaces\DriverRepositoryInterface;
use App\Models\Driver;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DriverRepository implements DriverRepositoryInterface
{
    public function getAll()
    {
        return Driver::all();
    }

    public function getById($id)
    {
        try {

            return Driver::findOrFail($id);

        } catch(ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex->getMessage(), 'Not found', 404);
        } catch(\Throwable $th) {
            return ApiResponseHelper::throw($th->getMessage(), 'Internal error', 500);
        }
    }

    public function store(array $data)
    {
        return Driver::create($data);
    }

    public function update(array $data, $id)
    {
        try {

            $driver = Driver::findOrFail($id);
            return $driver->update($data);

        } catch(ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex->getMessage(), 'Not found', 404);
        } catch(\Throwable $th) {
            return ApiResponseHelper::throw($th->getMessage(), 'Internal error', 500);
        }
    }
}
