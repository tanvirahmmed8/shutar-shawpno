<?php

namespace App\Contracts\Repositories;

interface AuthorRepositoryInterface extends RepositoryInterface
{
	public function updateOrCreate(array $params, array $value): mixed;

}
