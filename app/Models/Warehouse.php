<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = "warehouse";

    public function warehouseLocation()
    {
        return $this->hasMany('App\Models\WarehouseLocation');
    }
    
}
