<?php

namespace App\Exceptions;

use RuntimeException;

class InsufficientLotStockException extends RuntimeException
{
    public function __construct(string $message = 'Insufficient lot stock available for this product.')
    {
        parent::__construct($message);
    }
}
