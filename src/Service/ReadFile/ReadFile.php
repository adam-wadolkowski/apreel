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
    public function read(?string $fileName = 'test_short.txt'): bool
    {
        $fileFullPath = dirname(__DIR__, self::DIR_LEVEL_DOWN).self::RELATIVE_FILE_PATH.$fileName;

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
}