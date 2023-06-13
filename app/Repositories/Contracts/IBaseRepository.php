<?php

declare(strict_types=1);

namespace App\Repositories\Contracts;

use App\Dtos\BaseDto;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface IBaseRepository
{
    public function get(): Collection;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function getById(int $id): object;

    public function whereColumn(string $column, mixed $value, bool $collection = true): object|null;

    public function create(BaseDto $data): object;

    public function update(int $id, BaseDto $data): bool;

    public function delete(int $id): void;
}
