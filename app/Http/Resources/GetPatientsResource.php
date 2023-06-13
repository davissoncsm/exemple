<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetPatientsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(is_null($this->resource)){
            return [];
        }

        return [
            'name' => $this->name,
            'cpf' => $this->cpf,
            'cns' => $this->cns,
            'mother_name' => $this->mother_name,
            'birthdate' => $this->birthdate,
            'photo' => $this->photo,
            'address' => new GetPatientsAddressesResource($this->address)
        ];
    }
}
