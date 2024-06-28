<?php

namespace App\Repositories;

use App\Classes\ApiResponseHelper;
use App\Interfaces\OwnerRepositoryInterface;
use App\Models\Owner;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OwnerRepository implements OwnerRepositoryInterface

{
    public function getAll()
    {
        return Owner::all();
    }

    public function getById($id)
    {
        try {

            return Owner::findOrFail($id);

        } catch(ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex->getMessage(), 'Not found', 404);
        } catch(\Throwable $th) {
            return ApiResponseHelper::throw($th->getMessage(), 'Internal error', 500);
        }
    }

    public function store(array $data)
    {
        return Owner::create($data);
    }

    public function update(array $data, $id)
    {
        try {

            $owner = Owner::findOrFail($id);
            return $owner->update($data);

        } catch(ModelNotFoundException $ex) {
            return ApiResponseHelper::throw($ex->getMessage(), 'Not found', 404);
        } catch(\Throwable $th) {
            return ApiResponseHelper::throw($th->getMessage(), 'Internal error', 500);
        }
    }
}
