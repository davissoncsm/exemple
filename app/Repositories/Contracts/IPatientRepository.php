<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

interface IPatientRepository
{
    public function getFiltered(array $filters): object|null;
}
