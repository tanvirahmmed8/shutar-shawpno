<?php

namespace App\Contracts\Repositories;

interface ProductSeoRepositoryInterface extends RepositoryInterface
{
	public function updateByParams(array $params, array $data): bool;

	public function updateOrInsert(array $params, array $data): bool;

}
