<?php

namespace App\Interfaces;

interface OwnerRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update(array $data, $id);
}
