<?php

declare(strict_types=1);

namespace App\Service\ReadFile;

use App\Service\CheckFile\CheckFile;
use App\Service\GetFileFullPath\GetFileFullPath;
use App\Service\ReadFile\Interface\ReadFileInterface;
use Exception;

final class ReadFile implements ReadFileInterface
{
    private const DEFAULT_FILE_NAME = 'test_short.txt';
    private const LARGE_FILE_SIZE = (1<<29);//0,5GB

    private CheckFile $checkFile;

    //private SaveFile $saveFile;
    private GetFileFullPath $getFileFullPath;

    private ReadSmallFile $readSmallFile;

    private ReadBigFIle $readBigFIle;

    public function __construct()
    {
        $this->checkFile = new CheckFile();
        $this->getFileFullPath = new GetFileFullPath();
        $this->readSmallFile = new ReadSmallFile();
        $this->readBigFIle = new ReadBigFIle();
    }

    /**
     * @throws Exception
     */
    public function read(?string $fileName): bool
    {
        $fileName = $this->getFileName($fileName);
        $fileFullPath = $this->getFileFullPath->getFileFullPath($fileName);
        $this->checkFile->check($fileFullPath);

        if (filesize($fileFullPath) >= self::LARGE_FILE_SIZE) {
            return $this->readBigFIle->read($fileFullPath);
        }

        return $this->readSmallFile->read($fileFullPath, );
    }

    private function getFileName(?string $fileName): string
    {
        return $fileName ?? self::DEFAULT_FILE_NAME;
    }
}