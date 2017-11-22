<?php

namespace App\Services;

interface SalariesReportPdfServiceInterface
{
    /**
     * Create PDF document from given data and output it to the client
     *
     * @param array $data
     * @return string
     */
    public function getPdfContentFromData(array $data): string;
}