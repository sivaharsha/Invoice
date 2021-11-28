<?php
namespace App\Controllers;

// if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use  App\Models\InvoiceDetailsModel;


// require 'vendor/autoload.php';
// use Dompdf\Dompdf as Dompdf
// use App\Libraries\dompdf;
// echo BASEPATH;


class InvoiceController extends BaseController{

    public $invoiceDetailsModel;
    public $pdfdom;

    public function __construct(){
        
        $this->invoiceDetailsModel = new InvoiceDetailsModel();
        // $this->pdfdom = new dompdf();
     
    }


    public function index(){
        return view('invoice/add_invoice');
    }


    public function addInvoice(){
        $name= $this->request->getVar('name');
        $tax = $this->request->getVar('tax');
        $price = $this->request->getVar('price');
        $quantity = $this->request->getVar('quantity');
        
        $resStatus = array();

        for ($i=0; $i < count($name); $i++) { 
            $items = array(
            'name' => $name[$i],
            'tax' => $tax[$i],
            'unit_price' => $price[$i],
            'quantity' => $quantity[$i],
            'total' => ($price[$i] * $quantity[$i])+ ( $price[$i] * $quantity[$i] * $tax[$i] / 100),
            'total_wot' => $price[$i] * $quantity[$i]
            );
            $resStatus[] = $this->invoiceDetailsModel->addInvoiceItem($items);
        } 
        
        // $this->load->library('pdf');
        // $dompdf = new pdf();
        // $pdf= new Pdf();

        // $this->pdf->loadHtml('<h1>Hai</h1>');
        // $this->pdf->setPaper('A4', 'landscape');
        // $this->pdf->render();
        // $this->pdf->stream("welcome.pdf", array("Attachment"=>0));


        print_r($resStatus);
       



        // echo "<pre>";
        // print_r($items);
        // echo "</pre>";
        
    //    if($resStatus){
    //         echo "Inserted";
    //    }else {
    //         echo 'Something went wrong';
    //    }
        
    }
    
}

?>