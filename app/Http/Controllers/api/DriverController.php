<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Http\Resources\DriverResource;
use App\Interfaces\DriverRepositoryInterface;
use Illuminate\Support\Facades\DB;

class DriverController extends Controller
{
    private DriverRepositoryInterface $driverRepositoryInterface;

    public function __construct(DriverRepositoryInterface $driverRepositoryInterface)
    {
        $this->driverRepositoryInterface = $driverRepositoryInterface;
    }

    public function index()
    {
        $data = $this->driverRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(DriverResource::collection($data), '', 200);
    }

    public function show($id)
    {
        $driver = $this->driverRepositoryInterface->getById($id);
        return ApiResponseHelper::sendResponse(new DriverResource($driver), '', 200);
    }

    public function store(StoreDriverRequest $request)
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
            $driver = $this->driverRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new DriverResource($driver), 'Record create succesful', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function update(UpdateDriverRequest $request, $id)
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
            $this->driverRepositoryInterface->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Record updated succesful', 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }
}
