<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryProb extends Model
{
    protected $table = "inventory_prob";

    public function inventory()
    {
    	return $this->hasOne("App\Models\Inventory","id","inventory_id");
    }
}
