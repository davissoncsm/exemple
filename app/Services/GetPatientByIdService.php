<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\IPatientRepository;

class GetPatientByIdService
{
    private int $patientId;
    /**
     * @param IPatientRepository $repository
     */
    public function __construct(
        protected IPatientRepository $repository,
    ) {
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
     * @return object
     */
    public function run(): object
    {
        return $this->getPatient();
    }

    /**
     * @return object
     */
    private function getPatient(): object
    {
        return $this->repository->getById(id: $this->patientId);
    }
}
