<?php

namespace App\Service\SaveFIle;

use Generator;

final class SaveFile
{
    public function save(string $fileName, Generator $lines): void
    {
        $handle = fopen($fileName, 'w');
        foreach ($lines as $line) {
            fwrite($handle, $line);
        }
        fclose($handle);
    }
}