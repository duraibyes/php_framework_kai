<?php

namespace App\Apps\Controllers;

class Logger
{
    public function log($message)
    {
        show("[LOG] " . $message . "\n");
    }
}
// Usage example