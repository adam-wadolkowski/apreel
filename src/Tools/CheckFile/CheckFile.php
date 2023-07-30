<?php

declare(strict_types=1);

namespace App\Tools\CheckFile;

use Exception;
use App\Tools\CheckFile\Interface\CheckFileInterface;

final class CheckFile implements CheckFileInterface
{
    /**
     * @throws Exception
     */
    public final function check(string $fileFullPath): void
    {
        if (!$fileFullPath) {
            throw new Exception('File path or name not by empty.');
        }

        if (!file_exists($fileFullPath)) {
            throw new Exception('File not exist.');
        }

        if (!is_file($fileFullPath)) {
            throw new Exception('This is not a file.');
        }

        if (!is_readable($fileFullPath)) {
            throw new Exception('File ins not readable.');
        }
    }
}