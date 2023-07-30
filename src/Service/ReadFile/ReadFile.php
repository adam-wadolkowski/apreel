<?php

declare(strict_types=1);

namespace App\Service\ReadFile;

use App\Service\CheckFile\CheckFile;
use App\Service\ReadFile\Interface\ReadFileInterface;
use App\Service\ReplaceEndOfLine\ReplaceEndOfLine;
use ClosedGeneratorException;
use Exception;
use Generator;

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
        $fileName = $this->getFileName($fileName);
        $fileFullPath = $this->getFileFullPath($fileName);
        $this->checkFile->check($fileFullPath);

        $handle = fopen($fileFullPath, 'r');
        if ($handle) {
            $lines = $this->getLines($handle);
            $this->saveFile($this->getNewFileFullPath($fileName), $lines);
            fclose($handle);

            return true;
        }
        return false;
    }

    private function getFileFullPath(?string $fileName): string
    {
        return dirname(__DIR__, self::DIR_LEVEL_DOWN).self::RELATIVE_FILE_PATH.$fileName;
    }

    private function getNewFileFullPath(string $fileName): string
    {
        return $this->getFileFullPath(str_replace('.', '_new.', $fileName));
    }

    private function getLines($handle): Generator
    {
        while (($line = fgets($handle)) !== false)  {
            yield $this->replaceEndOfLine->replace($line);
        }
    }

    private function getFileName(?string $fileName): string
    {
        return $fileName ?? self::DEFAULT_FILE_NAME;
    }

    private function saveFile(string $fileName, Generator $body): void
    {
        $handle = fopen($fileName, 'w');
            foreach ($body as $bod) {
                fwrite($handle, $bod);
            }
        fclose($handle);
    }
}