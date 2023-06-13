<?php

declare(strict_types=1);

namespace App\Repositories\Core;

use App\Entities\PatientEntity;
use App\Repositories\Contracts\IPatientRepository;

class PatientRepository extends BaseRepository implements IPatientRepository

{
    /**
     * @return string
     */
    public function entity()
    {
        return PatientEntity::class;
    }

    /**
     * @param array $filters
     * @return object|null
     */
    public function getFiltered(array $filters): object|null
    {
        if(empty($filters)){
            return null;
        }

        $query = $this->entity->with('address');

        foreach ($filters as $key => $filter) {
            $query->where($key, $filter);
        }

        return $query->first();
    }
}
