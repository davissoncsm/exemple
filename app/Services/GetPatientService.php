<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\Contracts\IPatientRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class GetPatientService
{
    /**
     * @param IPatientRepository $repository
     */
    public function __construct(
        protected IPatientRepository $repository,
    ) {
    }

    /**
     * @return LengthAwarePaginator
     */
    public function run(): LengthAwarePaginator
    {
        return $this->getPatients();
    }

    /**
     * @return LengthAwarePaginator
     */
    private function getPatients(): LengthAwarePaginator
    {
        return $this->repository->paginate();
    }
}
