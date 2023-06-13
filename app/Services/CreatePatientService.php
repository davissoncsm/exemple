<?php

declare(strict_types=1);

namespace App\Services;

use App\Dtos\AddressDto;
use App\Dtos\PatientDto;
use App\Entities\PatientEntity;
use App\Repositories\Contracts\IAddressRepository;
use App\Repositories\Contracts\IPatientRepository;
use Illuminate\Support\Facades\Storage;

class CreatePatientService
{
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
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        $this->uploadPhoto();
        $this->createNewPatient();
        $this->createPatientAddress();
    }

    /**
     * @return void
     */
    private function uploadPhoto(): void
    {
        if (!is_null($this->patientDto->photo)) {

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
    private function createNewPatient(): void
    {
        $this->patient = $this->patientRepository->create(data: $this->patientDto);
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function createPatientAddress(): void
    {
        $this->addressDto->patientId = $this->patient->id;
        $this->addressRepository->create($this->addressDto);
    }

}
