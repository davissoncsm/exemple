<?php

declare(strict_types=1);

namespace App\Repositories\Core;

use App\Entities\AddressEntity;
use App\Repositories\Contracts\IAddressRepository;

class AddressRepository extends BaseRepository implements IAddressRepository
{
    /**
     * @return string
     */
    public function entity()
    {
        return AddressEntity::class;
    }


}
