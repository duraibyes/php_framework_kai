<?php

namespace App\Apps\Services;

use App\Apps\Interface\LoggerInterface;

class FileLogger implements LoggerInterface
{
    public function log(string $message)
    {
        echo "Logging to file: $message\n";
    }
}
