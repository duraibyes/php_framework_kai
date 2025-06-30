<?php

namespace App\Apps\Services;

use App\Apps\Interface\LoggerInterface;

class ReportService
{

    public function __construct(protected LoggerInterface $logger) {}

    public function generate()
    {
        $this->logger->log("Report generated.");
        return "📄 Report content";
    }
}
