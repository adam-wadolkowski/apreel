<?php

declare(strict_types=1);

namespace App;

use App\Service\File\File;

require dirname(__DIR__) . '/vendor/autoload.php';

$file = new File();
$file->read();