<?php

declare(strict_types=1);

namespace App\Service\ReplaceEndOfLine\Interface;

interface ReplaceEndOfLineInterface
{
    public function replace(string $line): string;
}