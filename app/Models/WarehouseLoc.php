<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseLoc extends Model
{
    protected $table = "warehouse_loc";

    // public function warehouse()
    // {
    //     return $this->belongsTo('App\Models\Warehouse');
    // }

    // public function warehouseRacking()
    // {
    //     return $this->hasMany('App\Models\WarehouseRacking');
    // }
    public function warehouse()
    {
    	return $this->hasOne("App\Models\Warehouse","id","wh_id");
    }
}
