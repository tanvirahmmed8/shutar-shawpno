<?php

namespace App\Contracts\Repositories;

interface RestockProductRepositoryInterface extends RepositoryInterface
{
	public function getListWhereBetween(array $orderBy = [], string $searchValue = null, array $filters = [], array $relations = [], string $whereBetween = null, array $whereBetweenFilters = [], int|string $takeItem = null, int|string $dataLimit = DEFAULT_DATA_LIMIT, int $offset = null): \Illuminate\Database\Eloquent\Collection|\Illuminate\Pagination\LengthAwarePaginator;

	public function updateByParams(array $params, array $data): bool;

	public function updateOrCreate(array $params, array $value): mixed;

}
