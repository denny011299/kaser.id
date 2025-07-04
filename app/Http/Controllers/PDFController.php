<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function deliveryOrder($id)
    {
        $data["do"] = (new DeliveryOrder())->getDeliveryOrders(["do_id"=>$id])[0];
    
        $pdf =  Pdf::loadView('Backoffice.PDF.ExportSuratJalan',$data);
        $pdf->set_option('isHtml5ParserEnabled', true);
        $pdf->set_option('default_font', 'normal');
        $pdf->setOption('fontDir', public_path('/fonts'));
    
        return $pdf->stream();
        //return $pdf->download($data["tour_name"].".pdf");
    }
   
}
