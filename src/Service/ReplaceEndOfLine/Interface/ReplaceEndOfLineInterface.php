<?php

namespace App\Service\ReplaceEndOfLine\Interface;

interface ReplaceEndOfLineInterface
{
    public function replace(string $line): string;
}