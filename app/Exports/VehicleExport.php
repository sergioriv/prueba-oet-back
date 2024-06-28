<?php

namespace App\Exports;

use App\Interfaces\VehicleRepositoryInterface;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VehicleExport implements FromArray, ShouldAutoSize, WithStyles
{
    private VehicleRepositoryInterface $vehicleRepositoryInterface;

    public function __construct(VehicleRepositoryInterface $vehicleRepositoryInterface)
    {
        $this->vehicleRepositoryInterface = $vehicleRepositoryInterface;
    }

    public function array(): array
    {
        $content = [
            ["Placa", "Marca", "Conductor", "Propietario"]
        ];

        $vehicles = $this->vehicleRepositoryInterface->getAll();

        foreach ($vehicles as $vehicle) {
            $content[] = [
                $vehicle->license_plate,
                $vehicle->make,
                $vehicle->driver->full_name,
                $vehicle->owner->full_name
            ];
        }
        return $content;
    }

    public function styles(Worksheet $sheet)
    {
    }
}
