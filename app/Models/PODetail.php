<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PODetail extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'po_supplier_detail';

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }

    public function po(){
    	return $this->belongsTo('App\Models\PurchaseOrder');
    }

    public function po2()
    {
    	return $this->hasOne("App\Models\PurchaseOrder","id","pos_id");
    }
}
