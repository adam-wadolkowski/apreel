<?php

declare(strict_types=1);

namespace App\Service\CheckFile;

use App\Exception\FileNotExistException;
use Exception;
use App\Service\CheckFile\Interface\CheckFileInterface;

final class CheckFile implements CheckFileInterface
{
    /**
     * @throws Exception
     */
    public final function check(string $fileFullPath): bool
    {
        if (!$fileFullPath) {
            throw new Exception('File path or name not by empty.');
        }

        if (!file_exists($fileFullPath)) {
            throw new FileNotExistException($fileFullPath);
        }

        if (!is_file($fileFullPath)) {
            throw new Exception('This is not a file.');
        }

        if (!is_readable($fileFullPath)) {
            throw new Exception('File ins not readable.');
        }

        return true;
    }
}