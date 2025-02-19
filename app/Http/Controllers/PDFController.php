<?php

namespace App\Http\Controllers;

use App\Models\Profits;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller {

    // function to display preview
    public function preview() {
        $Profits = Profits::where('status', 1)->get();
        return view('profit.pdf.preview', ['Profits' => $Profits]);
    }

    public function generatePDF() {
        $Profits = Profits::where('status', 1)->get();
        $pdf = PDF::loadView('profit.pdf.preview', ['Profits' => $Profits]);
        return $pdf->download('demo.pdf');
    }

}
