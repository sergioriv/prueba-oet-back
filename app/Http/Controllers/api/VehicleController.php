<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Interfaces\VehicleRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class VehicleController extends Controller
{
    private VehicleRepositoryInterface $vehicleRepositoryInterface;

    public function __construct(VehicleRepositoryInterface $vehicleRepositoryInterface)
    {
        $this->vehicleRepositoryInterface = $vehicleRepositoryInterface;
    }

    public function index()
    {
        $data = $this->vehicleRepositoryInterface->getAll();
        return ApiResponseHelper::sendResponse(VehicleResource::collection($data), '', 200);
    }

    public function show($id)
    {
        $vehicle = $this->vehicleRepositoryInterface->getById($id);
        return ApiResponseHelper::sendResponse(new VehicleResource($vehicle), '', 200);
    }

    public function store(StoreVehicleRequest $request)
    {
        $data = [
            'license_plate' => $request->license_plate,
            'color' => $request->color,
            'make' => $request->make,
            'is_private' => $request->is_private,
            'driver_id' => $request->driver,
            'owner_id' => $request->owner,
        ];

        DB::beginTransaction();
        try {
            $vehicle = $this->vehicleRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new VehicleResource($vehicle), 'Record create succesful', 201);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function update(UpdateVehicleRequest $request, $id)
    {
        $data = [
            'color' => $request->color,
            'make' => $request->make,
            'is_private' => $request->is_private,
            'driver_id' => $request->driver,
            'owner_id' => $request->owner,
        ];

        DB::beginTransaction();
        try {
            $this->vehicleRepositoryInterface->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Record updated succesful', 200);
        } catch (\Exception $ex) {
            DB::rollBack();
            return ApiResponseHelper::rollback($ex);
        }
    }

    public function report()
    {
        return Excel::download(new \App\Exports\VehicleExport($this->vehicleRepositoryInterface), "vehiculos.xlsx");
    }
}
