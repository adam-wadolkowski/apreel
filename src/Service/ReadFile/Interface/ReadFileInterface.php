<?php

declare(strict_types=1);

namespace App\Service\ReadFile\Interface;
interface ReadFileInterface
{
    public function read(?string $fileName = 'test_short.txt'): bool;
}