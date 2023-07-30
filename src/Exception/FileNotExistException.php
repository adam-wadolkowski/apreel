<?php

namespace App\Exception;

use Exception;
use Throwable;

final class FileNotExistException extends Exception
{
    private const MESSAGE = 'File not exist.';
    public function __construct(?string $message = null, $code = 0, Throwable $previous = null) {
        parent::__construct(null === $message ? self::MESSAGE : $message.' '.self::MESSAGE, $code, $previous);
    }
}