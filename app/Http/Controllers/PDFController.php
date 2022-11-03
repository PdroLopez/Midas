<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

class PDFController extends Controller
{
    public function pdf()
    {
        $pdf = PDF::loadview('pdf');
        return $pdf->download('prueba'.'.pdf');
    }
}
