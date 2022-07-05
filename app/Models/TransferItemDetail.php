<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferItemDetail extends Model
{
    protected $table = "transfer_items_detail";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
}
