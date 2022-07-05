<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferItem extends Model
{
    protected $table = "transfer_items";

    public function transferitemdetail()
    {
        return $this->hasMany("App\Models\TransferItemDetail");
    }

    public function warehouse1()
    {
    	return $this->hasOne("App\Models\WarehouseLoc","id","from_location");
    }
    public function warehouse2()
    {
    	return $this->hasOne("App\Models\WarehouseLoc","id","to_location");
    }
  
    
}

// <?php

// namespace App\Models;su

// use Illuminate\Database\Eloquent\Model;

// class Inventory extends Model
// {
//     protected $table = "inventory";

//     public function products()
//     {
//     	return $this->hasOne("App\Models\Product","id","product_id");
//     }
//     public function warehouse()
//     {
//     	return $this->hasOne("App\Models\Warehouse","id","warehouse_id");
//     }
//     public function location()
//     {
//     	return $this->hasOne("App\Models\WarehouseLocation","id","location_id");
//     }
// }

