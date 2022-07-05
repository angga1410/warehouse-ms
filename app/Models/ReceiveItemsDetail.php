<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveItemsDetail extends Model
{
    protected $table = "receive_items_detail";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }

    public function inventory()
    {
    	return $this->hasOne("App\Models\Inventory","product_id","product_id");
    }
}
