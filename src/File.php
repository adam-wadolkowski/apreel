<?php

declare(strict_types=1);

namespace App;

use App\Tools\CheckFile\CheckFile;

final class File
{
    private const RELATIVE_FILE_PATH = '/file/';
    private CheckFile $checkFile;
    public function __construct()
    {
        $this->checkFile = new CheckFile();
    }

    /**
     * @throws \Exception
     */
    public function read(?string $fileName = 'test_short.txt'): void
    {
        $fileFullPath = dirname(__DIR__).self::RELATIVE_FILE_PATH.$fileName;

        $this->checkFile->check($fileFullPath);

        $handle = fopen($fileFullPath, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                var_dump($line);
            }
        fclose($handle);
        }
    }
}