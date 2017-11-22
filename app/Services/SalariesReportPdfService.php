<?php

namespace App\Services;


use Mpdf\Mpdf;
use Mpdf\Output\Destination;

class SalariesReportPdfService implements SalariesReportPdfServiceInterface
{
    /**
     * Create PDF document from given data and output it to the client
     *
     * @param array $data
     * @return string
     */
    public function getPdfContentFromData(array $data): string
    {
        $mpdf = new Mpdf();

        $mpdf->writeHTML('<h1>Hello world</h1>');

        return $mpdf->Output(null, Destination::STRING_RETURN);
    }
}