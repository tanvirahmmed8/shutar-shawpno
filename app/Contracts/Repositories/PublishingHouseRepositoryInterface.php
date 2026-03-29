<?php

namespace App\Contracts\Repositories;

interface PublishingHouseRepositoryInterface extends RepositoryInterface
{
	public function updateOrCreate(array $params, array $value): mixed;

}
