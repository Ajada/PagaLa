<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Dompdf\Dompdf;
use Dompdf\Options;

class DompdfController extends Controller
{
    public function generatePdf($page, $title, $orientation = 'landscape')
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $options->setIsRemoteEnabled(true); // active in production

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml($page);
        $dompdf->setPaper('A4', $orientation);

        $dompdf->render();

        $pdfPath = storage_path('app/public/temp/' . $title . '.pdf');
        file_put_contents($pdfPath, $dompdf->output());

        return asset('storage/temp/' . $title . '.pdf');
    }
}
