<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickItemDetail extends Model
{
    protected $table = "pick_item_detail";
    
    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
    public function warehouses()
    {
    	return $this->hasOne("App\Models\Warehouse","id","warehouse");
    }
    
}
