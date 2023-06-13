<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\IPatientRepository;

class GetFilteredPatientService
{
    private array|null $filters = null;


    /**
     * @param IPatientRepository $repository
     */
    public function __construct(
        protected IPatientRepository $repository,
    ) {
    }

    /**
     * @param array $filters
     * @return static
     */
    public function setFilters(array $filters): static
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * @return object|null
     */
    public function run(): object|null
    {
        return $this->getPatient();
    }


    /**
     * @return object|null
     */
    private function getPatient(): object|null
    {
        return $this->repository->getFiltered(filters: $this->filters);
    }

}
