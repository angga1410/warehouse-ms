<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnReportDetail extends Model
{
    protected $table = "return_report_detail";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }

}
