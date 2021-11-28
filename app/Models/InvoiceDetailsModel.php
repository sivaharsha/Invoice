<?php

namespace App\Models;

use CodeIgniter\Model;


class InvoiceDetailsModel extends Model{
    
    protected $table = 'invoiceDetails';
    protected $primaryKey = 'id';

    protected $allowedFields = ['name','quantity','unit_price','tax','total','total_wot','invoice_id'];

    public function addInvoiceItem($items){

        echo "<pre>";
        print_r($items);
        echo "</pre>";


    $this->insert($items);
    if($this->db->affectedRows() === 1) {
        return $this->insertID();
    }else {
        return false;
    }

    }


}


?>