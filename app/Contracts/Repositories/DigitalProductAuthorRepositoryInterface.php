<?php

namespace App\Contracts\Repositories;

interface DigitalProductAuthorRepositoryInterface extends RepositoryInterface
{
	public function updateOrCreate(array $params, array $value): mixed;

	public function deleteWhereNotIn(string $searchValue = null, array $filters = [], array $nullFields = [], array $whereNotIn = []): mixed;

}
