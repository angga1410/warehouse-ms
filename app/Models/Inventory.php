<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = "inventory";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
    public function warehouse()
    {
    	return $this->hasOne("App\Models\WarehouseLoc","id","warehouse_id");
    }
    public function location()
    {
    	return $this->hasOne("App\Models\WarehouseLocation","id","location_id");
    }
    public function rack()
    {
    	return $this->hasOne("App\Models\WarehouseRacking","id","rack_id");
    }
    public function reserve()
    {
        return $this->belongsTo('App\Models\ReserveStock','inventory_id');
    }
}
