<?php

namespace App\Service\ReplaceEndOfLine;

use App\Service\ReplaceEndOfLine\Interface\ReplaceEndOfLineInterface;

class ReplaceEndOfLine implements ReplaceEndOfLineInterface
{
    private const NO_UNIX_END_OF_LINE = ['\r', '\n'];
    private const UNIX_END_OF_LINE = '\r\n';
    public function replace(string $line): string
    {
        return str_replace(self::NO_UNIX_END_OF_LINE, self::UNIX_END_OF_LINE, $line);
    }
}