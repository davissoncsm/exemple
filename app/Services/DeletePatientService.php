<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\IPatientRepository;

class DeletePatientService
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
     * @return void
     * @throws \Exception
     */
    public function run(): void
    {
        $this->deletePatient();
    }

    /**
     * @return void
     * @throws \Exception
     */
    private function deletePatient(): void
    {
        $this->repository->delete(id: $this->patientId);
    }

}
