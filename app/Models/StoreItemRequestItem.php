<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreItemRequestItem extends Model
{
    protected $table = "store_item_request_detail";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
}
