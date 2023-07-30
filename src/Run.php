<?php

declare(strict_types=1);

namespace App;

use App\Service\ReadFile\ReadFile;

require dirname(__DIR__) . '/vendor/autoload.php';

$file = new ReadFile();
$file->read($argv[1] ?? null);