<?php

declare(strict_types=1);

namespace App\Service\ReadFile;

class ReadSmallFile
{
    private GetLines $getLines;
    public function __construct()
    {
        $this->getLines = new GetLines();
    }
    public function read(string $fileFullPath): bool
    {
        $handle = fopen($fileFullPath, 'r');
        if ($handle) {
            $lines = $this->getLines->get($handle);
            //$this->saveFile->save($this->getFileFullPath->getNewFileFullPath($fileName), $lines);
            fclose($handle);

            return true;
        }
        return false;
    }
}