<?php

namespace App\Exception;

use Exception;
use Throwable;

final class FileNotExistException extends Exception
{
    public function __construct(?string $message = 'File not exist', $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}