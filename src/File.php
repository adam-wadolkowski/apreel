<?php

namespace App;

use Exception;

final class File
{
    private const RELATIVE_FILE_PATH = '/file/';
    
    public function read(?string $fileName = 'test.txt'): void
    {
        $fileFullPath = dirname(__DIR__).self::RELATIVE_FILE_PATH.$fileName;

        $this->checkFile($fileFullPath);

        $handle = fopen($fileFullPath, 'r');
        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                echo $line;
            }
        fclose($handle);
        }
    }

    private function checkFile(string $fileFullPath): void
    {
        if (!file_exists($fileFullPath)) {
            throw new Exception('File not exist.');
        }

        if (!is_file($fileFullPath)) {
            throw new Exception('This is not a file.');
        }

        if (!is_readable($fileFullPath)) {
            throw new Exception('File ins not readable.');
        }
    }
}