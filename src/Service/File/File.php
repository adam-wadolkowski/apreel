<?php

declare(strict_types=1);

namespace App\Service\File;

use App\Service\CheckFile\CheckFile;
use Exception;

final class File
{
    private const RELATIVE_FILE_PATH = '/file/';
    private const DIR_LEVEL_DOWN = 3;
    private CheckFile $checkFile;
    public function __construct()
    {
        $this->checkFile = new CheckFile();
    }

    /**
     * @throws Exception
     */
    public function read(?string $fileName = 'test_short.txt'): bool
    {
        $fileFullPath = dirname(__DIR__, self::DIR_LEVEL_DOWN).self::RELATIVE_FILE_PATH.$fileName;

        $this->checkFile->check($fileFullPath);

        $handle = fopen($fileFullPath, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = str_replace(['\r', '\n'], '\r\n', $line);
                var_dump($line);
            }
            fclose($handle);

            return true;
        }
        return false;
    }
}