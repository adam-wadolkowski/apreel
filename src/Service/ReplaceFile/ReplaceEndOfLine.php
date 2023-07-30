<?php

namespace App\Service\ReplaceFile;

use App\Service\ReplaceFile\Interface\ReplaceEndOfLineInterface;

class ReplaceEndOfLine implements ReplaceEndOfLineInterface
{
    private const NO_UNIX_END_OF_LINE = ['\r', '\n'];
    private const UNIX_END_OF_LINE = '\r\n';
    public function replace(string $line): string
    {
        return str_replace(self::NO_UNIX_END_OF_LINE, self::UNIX_END_OF_LINE, $line);
    }
}