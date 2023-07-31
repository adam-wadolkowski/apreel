<?php

declare(strict_types=1);

namespace App\Service\ReadFile;

use App\Service\CheckFile\CheckFile;
use App\Service\GetFileFullPath\GetFileFullPath;
use App\Service\ReadFile\Interface\ReadFileInterface;
use App\Service\ReplaceEndOfLine\ReplaceEndOfLine;
use App\Service\SaveFIle\SaveFile;
use Exception;
use Generator;

final class ReadFile implements ReadFileInterface
{
    private const DEFAULT_FILE_NAME = 'test_short.txt';
    private const FILE_CHUNK_SIZE = (1<<24);

    private CheckFile $checkFile;
    private ReplaceEndOfLine $replaceEndOfLine;

    private SaveFile $saveFile;
    private GetFileFullPath $getFileFullPath;

    public function __construct()
    {
        $this->checkFile = new CheckFile();
        $this->replaceEndOfLine = new ReplaceEndOfLine();
        $this->saveFile = new SaveFile();
        $this->getFileFullPath = new GetFileFullPath();
    }

    /**
     * @throws Exception
     */
    public function read(?string $fileName): bool
    {
        $fileName = $this->getFileName($fileName);
        $fileFullPath = $this->getFileFullPath->getFileFullPath($fileName);
        $this->checkFile->check($fileFullPath);

        $handle = fopen($fileFullPath, 'r');
        if ($handle) {
            $lines = $this->getLines($handle);
            $this->saveFile->save($this->getFileFullPath->getNewFileFullPath($fileName), $lines);
            fclose($handle);

            return true;
        }
        return false;
    }

    private function getLines($handle): Generator
    {
        while (($line = fgets($handle, self::FILE_CHUNK_SIZE)) !== false)  {
            yield $this->replaceEndOfLine->replace($line);
        }
    }

    private function getFileName(?string $fileName): string
    {
        return $fileName ?? self::DEFAULT_FILE_NAME;
    }
}