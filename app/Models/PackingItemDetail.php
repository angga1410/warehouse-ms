<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackingItemDetail extends Model
{
    protected $table = "packing_item_detail";

   	public function products()
    {
    	return $this->hasOne("App\Models\Product","id","product_id");
    }
    
    
}
