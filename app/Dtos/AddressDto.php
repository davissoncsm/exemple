<?php

declare(strict_types=1);

namespace App\Dtos;

use Illuminate\Http\UploadedFile;

class AddressDto extends BaseDto
{
    /**
     * @param string $street
     * @param string $number
     * @param string $neighborhood
     * @param string $city
     * @param string $state
     * @param string $cep
     * @param int|null $patientId
     * @param string|null $complement
     */
    public function __construct(
        public string $street,
        public string $number,
        public string $neighborhood,
        public string $city,
        public string $state,
        public string $cep,
        public int|null $patientId = null,
        public string|null $complement = null,
    ){}

    public function toArray(): array
    {
        return [
            'patient_id' => $this->patientId,
            'street' => $this->street,
            'number' => $this->number,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,
            'cep' => $this->cep,
            'complement' => $this->complement,
        ];
    }
}
