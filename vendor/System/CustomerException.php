<?php

declare(strict_types = 1);

namespace System;

use Exception;

class CustomerException extends \Exception
{
    public function __construct(string $message, int $code, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}