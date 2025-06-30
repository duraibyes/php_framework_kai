<?php

namespace App\Apps\Controllers;

class Controller
{
    public function __construct(protected Logger $logger) {}

    public function canCheck()
    {
        echo 'can check is called';
        $this->logger->log('canCheck method was called by logger');
    }
}
