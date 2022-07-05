<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveReportDetailSerialNo extends Model
{
    protected $table = "receive_report_detail_no";

     public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }


}
