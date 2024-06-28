<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOwnerRequest;
use App\Http\Requests\UpdateOwnerRequest;
use App\Http\Resources\OwnerResource;
use App\Interfaces\OwnerRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OwnerController extends Controller
{
    private OwnerRepositoryInterface $ownerRepositoryInterface;

    public function __construct(OwnerRepositoryInterface $ownerRepositoryInterface)
    {
        $this->ownerRepositoryInterface = $ownerRepositoryInterface;
    }

    public function index()
    {
        $data = $this->ownerRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(OwnerResource::collection($data), '', 200);
    }

    public function show($id)
    {
        $owner = $this->ownerRepositoryInterface->getById($id);
        return ApiResponseHelper::sendResponse(new OwnerResource($owner), '', 200);
    }

    public function store(StoreOwnerRequest $request)
    {
        $data = [
            'document' => $request->document,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_names' => $request->last_names,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone
        ];

        DB::beginTransaction();
        try {
            $owner = $this->ownerRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new OwnerResource($owner), 'Record create succesful', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function update(UpdateOwnerRequest $request, $id)
    {
        $data = [
            'document' => $request->document,
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'last_names' => $request->last_names,
            'address' => $request->address,
            'city' => $request->city,
            'phone' => $request->phone
        ];

        DB::beginTransaction();
        try {
            $this->ownerRepositoryInterface->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Record updated succesful', 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }
}
