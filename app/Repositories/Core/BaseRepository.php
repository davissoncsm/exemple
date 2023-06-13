<?php

declare(strict_types=1);

namespace App\Repositories\Core;

use App\Dtos\BaseDto;
use App\Exceptions\NotEntityDefinedException;
use App\Repositories\Contracts\IBaseRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BaseRepository implements IBaseRepository
{
    protected $entity;

    /**
     * @throws NotEntityDefinedException
     */
    public function __construct()
    {
        $this->entity = $this->resolvEntity();
    }

    /**
     * @return mixed
     * @throws NotEntityDefinedException
     */
    public function resolvEntity()
    {
        if (!method_exists($this, 'entity')) {
            throw new NotEntityDefinedException();
        }

        return app($this->entity());
    }

    /**
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->entity->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->entity->paginate($perPage);
    }

    /**
     * @param int $id
     * @return object
     */
    public function getById(int $id): object
    {
        return $this->entity->find($id);
    }

    /**
     * @param string $column
     * @param mixed $value
     * @param bool $collection
     * @return object|null
     */
    public function whereColumn(string $column, mixed $value, bool $collection = true): object|null
    {
        $query = $this->entity->where($column, $value);

        if($collection){
            return $query->get();
        }

        return $query->first();

    }

    /**
     * @param BaseDto $data
     * @return object
     * @throws \Exception
     */
    public function create(BaseDto $data): object
    {
        return $this->run(fn() => $this->entity->create($data->toArray()));
    }

    /**
     * @param int $id
     * @param BaseDto $data
     * @return bool
     * @throws \Exception
     */
    public function update(int $id, BaseDto $data): bool
    {
        return $this->run(
            fn() => $this->entity
                ->findOrfail($id)
                ->update($data->toArray())
        );
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function delete(int $id): void
    {
        $this->run(
            fn() => $this->entity
                ->findOrfail($id)
                ->delete()
        );
    }

    /**
     * @param $closure
     * @return object|bool
     * @throws \Exception
     */
    public function run($closure): object|bool
    {
        try {
            DB::beginTransaction();

            $execute = call_user_func($closure);

            DB::commit();

            return $execute;
        } catch (\Exception $e) {
            DB::rollBack();

            throw new \Exception($e->getMessage());
        }
    }
}
