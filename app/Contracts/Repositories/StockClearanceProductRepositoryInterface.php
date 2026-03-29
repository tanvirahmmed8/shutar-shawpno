<?php

namespace App\Contracts\Repositories;

interface StockClearanceProductRepositoryInterface extends RepositoryInterface
{
	public function updateByParams(array $params, array $data): bool;

	public function updateOrCreate(array $params, array $value): mixed;

}
