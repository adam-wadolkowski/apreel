<?php

declare(strict_types=1);

namespace App\Service\ReadFile;

use App\Service\ReplaceEndOfLine\ReplaceEndOfLine;
use Generator;

class GetLines
{
    private const DEFAULT_FILE_CHUNK_SIZE = 1024;

    private ReplaceEndOfLine $replaceEndOfLine;
    public function __construct()
    {
        $this->replaceEndOfLine = new ReplaceEndOfLine();
    }

    public function get($handle, ?int $fileChunkSize = self::DEFAULT_FILE_CHUNK_SIZE): Generator
    {
        while (($line = fgets($handle, $fileChunkSize)) !== false)  {
            yield $this->replaceEndOfLine->replace($line);
        }
    }
}