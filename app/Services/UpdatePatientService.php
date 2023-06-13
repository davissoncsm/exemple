<?php

declare(strict_types=1);

namespace App\Services;

use App\Dtos\AddressDto;
use App\Dtos\PatientDto;
use App\Entities\PatientEntity;
use App\Repositories\Contracts\IAddressRepository;
use App\Repositories\Contracts\IPatientRepository;
use Illuminate\Support\Facades\Storage;

class UpdatePatientService
{
    private int $patientId;
    private PatientDto $patientDto;

    private AddressDto $addressDto;

    private PatientEntity $patient;

    /**
     * @param IPatientRepository $patientRepository
     * @param IAddressRepository $addressRepository
     */
    public function __construct(
        protected IPatientRepository $patientRepository,
        protected IAddressRepository $addressRepository,
    ) {
    }

    /**
     * @param PatientDto $patientDto
     * @return $this
     */
    public function setPatientDto(PatientDto $patientDto): static
    {
        $this->patientDto = $patientDto;
        return $this;
    }

    /**
     * @param AddressDto $addressDto
     * @return $this
     */
    public function setAddressDto(AddressDto $addressDto): static
    {
        $this->addressDto = $addressDto;
        return $this;
    }

    /**
     * @param int $patientId
     * @return $this
     */
    public function setPatientId(int $patientId): static
    {
        $this->patientId = $patientId;
        return $this;
    }


    /**
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        $this->uploadPhoto();
        $this->updatePatient();
        $this->updatePatientAddress();
    }

    /**
     * @return void
     */
    private function uploadPhoto(): void
    {
        if(!is_null($this->patientDto->photo)){
            $name = uniqid(date('HisYmd'), true);
            $extension = $this->patientDto->photo->extension();

            $fileName = "{$name}.{$extension}";

            $path = Storage::putFileAs(
                path: 'patients/photos',
                file: $this->patientDto->photo,
                name: $fileName
            );

            $this->patientDto->filePath = $path;
        }
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function updatePatient(): void
    {
        $this->patientRepository->update(id: $this->patientId, data: $this->patientDto);
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function updatePatientAddress(): void
    {
        $address = $this->addressRepository
                        ->whereColumn(
                            column: 'patient_id',
                            value: $this->patientId,
                            collection: false
                        );

        if(!is_null($address)){
            $this->addressDto->patientId = $address->patient_id;
            $this->addressRepository->update(id: $address->id, data: $this->addressDto);
        }
    }
}
