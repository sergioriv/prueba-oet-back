<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/*
 * Proporciona una forma estructurada y consistente de transformar y formatear nuestros modelos de Eloquent para las respuestas Json de la api.
 * Permite encapsular la lógica de presentación y estructuración de datos, para mantener una separación entre la lógica del negocio y la representación de datos.
 * Controla como los datos se exponen a través de la api
 */
class OwnerResource extends JsonResource
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
            'document' => $this->document,
            'first_name' => $this->first_name,
            'second_name' => $this->second_name,
            'last_names' => $this->last_names,
            'full_name' => $this->full_name,
            'address' => $this->address,
            'city' => $this->city,
            'phone' => $this->phone
        ];
    }
}
