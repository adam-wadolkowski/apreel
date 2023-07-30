<?php

namespace App\Service\ReplaceFile\Interface;

interface ReplaceEndOfLineInterface
{
    public function replace(string $line): string;
}