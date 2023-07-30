<?php

declare(strict_types=1);

namespace App\Service\CheckFile\Interface;

interface CheckFileInterface
{
    public function check(string $fileFullPath): bool;
}