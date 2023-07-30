<?php

declare(strict_types=1);

namespace App\Tools\CheckFile\Interface;

interface CheckFileInterface
{
    public function check(string $fileFullPath): void;
}