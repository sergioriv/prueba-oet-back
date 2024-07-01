<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/*
 * Proporciona una forma estructurada y consistente de transformar y formatear nuestros modelos de Eloquent para las respuestas Json de la api.
 * Permite encapsular la lógica de presentación y estructuración de datos, para mantener una separación entre la lógica del negocio y la representación de datos.
 * Controla como los datos se exponen a través de la api
 */
class VehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'license_plate' => $this->license_plate,
            'color' => $this->color,
            'make' => $this->make,
            'type' => $this->type,
            'is_private' => $this->is_private,
            'address' => $this->address,
            'driver' => $this->driver,
            'owner' => $this->owner
        ];
    }
}
