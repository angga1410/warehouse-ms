<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveReportDetail extends Model
{
    protected $table = "receive_report_detail";

     public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
    public function po()
    {
    	return $this->hasOne("App\Models\ReceiveReport","id","receive_report_id");
    }
    public function PoDetail()
    {
    	return $this->hasOne("App\Models\PODetail","id","po_detail_id");
    }


}
