<?php

namespace App\Service\ReplaceFile;

use App\Service\ReplaceFile\Interface\ReplaceEndOfLineInterface;

class ReplaceEndOfLine implements ReplaceEndOfLineInterface
{
    public function replace(string $line): string
    {
        return str_replace(['\r', '\n'], '\r\n', $line);
    }
}