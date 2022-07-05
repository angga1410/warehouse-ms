<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveItemFromWHDetail extends Model
{
    protected $table = "receive_item_from_wh_detail";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
}
