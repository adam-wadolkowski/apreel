<?php

declare(strict_types=1);

namespace App\Service\ReadFile;

use App\Service\CheckFile\CheckFile;
use App\Service\ReadFile\Interface\ReadFileInterface;
use App\Service\ReplaceFile\ReplaceEndOfLine;
use Exception;

final class ReadFile implements ReadFileInterface
{
    private const RELATIVE_FILE_PATH = '/file/';
    private const DEFAULT_FILE_NAME = 'test_short.txt';
    private const DIR_LEVEL_DOWN = 3;
    private CheckFile $checkFile;
    private ReplaceEndOfLine $replaceEndOfLine;
    public function __construct()
    {
        $this->checkFile = new CheckFile();
        $this->replaceEndOfLine = new ReplaceEndOfLine();
    }

    /**
     * @throws Exception
     */
    public function read(?string $fileName): bool
    {
        $fileFullPath = $this->getFileFullPath($fileName);
        $this->checkFile->check($fileFullPath);

        $handle = fopen($fileFullPath, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                $line = $this->replaceEndOfLine->replace($line);
                var_dump($line);
            }
            fclose($handle);

            return true;
        }
        return false;
    }

    private function getFileFullPath(?string $fileName): string
    {
        $fileName = $fileName ?? self::DEFAULT_FILE_NAME;
        return dirname(__DIR__, self::DIR_LEVEL_DOWN).self::RELATIVE_FILE_PATH.$fileName;
    }
}