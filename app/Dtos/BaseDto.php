<?php

declare(strict_types=1);

namespace App\Dtos;

abstract class BaseDto
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
