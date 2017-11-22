<?php

namespace App\Http\Controllers;


use App\Services\SalariesReportPdfServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ExportController extends Controller
{
    public function __invoke(Request $request, SalariesReportPdfServiceInterface $pdfService)
    {
        return response($pdfService->getPdfContentFromData($request->input()))
            ->header('Content-Type', 'application/pdf');
    }
}