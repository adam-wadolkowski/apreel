<?php

namespace App\Service\GetFileFullPath;

final class GetFileFullPath
{
    private const DIR_LEVEL_DOWN = 3;
    private const RELATIVE_FILE_PATH = '/file/';
    public function getFileFullPath(?string $fileName): string
    {
        return dirname(__DIR__, self::DIR_LEVEL_DOWN).self::RELATIVE_FILE_PATH.$fileName;
    }

    public function getNewFileFullPath(string $fileName): string
    {
        return $this->getFileFullPath(str_replace('.', '_new.', $fileName));
    }
}