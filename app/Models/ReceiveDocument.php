<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveDocument extends Model
{
    protected $table = "receive_document";

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function mover()
    {
        return $this->belongsTo('App\Models\Mover');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\SupplierVendor','source_id');
    }
    public function po()
    {
        return $this->belongsTo('App\Models\PurchaseOrder','po_id');
    }
    

}