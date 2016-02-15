<?php
namespace App\Services;

use App\Invoice;
use View;

trait ViewinvoiceTrait {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInvoicex($order_id) {
		
        $id = $order_id;

        $invoicedata = Invoice::where('Id', $id)->get();


        $html22 = View('viewinvoice')->with(array('invoicedata' => $invoicedata))->render();

        require_once(app_path() . '/libs/html2pdf/html2pdf.class.php');


        $html2pdf = new \HTML2PDF('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));

        // $html2pdf->pdf->SetDisplayMode('fullpage');

        $html2pdf->WriteHTML($html22);

        return $html2pdf->Output('Invoice.pdf');
    }

}