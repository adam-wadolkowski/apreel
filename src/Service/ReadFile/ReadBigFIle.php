<?php

declare(strict_types=1);

namespace App\Service\ReadFile;

class ReadBigFIle
{
    private const FILE_CHUNK_SIZE = (1<<24); //16MB

    private GetLines $getLines;
    public function __construct()
    {
        $this->getLines = new GetLines();
    }
    public function read(?string $fileFullPath): bool
    {
        $handle = fopen($fileFullPath, 'r');
        if ($handle) {
            $lines = $this->getLines->get($handle, self::FILE_CHUNK_SIZE);
            //$this->saveFile->save($this->getFileFullPath->getNewFileFullPath($fileName), $lines);
            fclose($handle);

            return true;
        }
        return false;
    }
}