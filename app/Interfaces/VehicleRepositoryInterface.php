<?php

namespace App\Interfaces;

interface VehicleRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update(array $data, $id);
}
