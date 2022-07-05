<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreItemsDetail extends Model
{
    protected $table = "store_items_detail";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
}
