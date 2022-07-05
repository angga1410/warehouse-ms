<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionInventory extends Model
{
    protected $table = "transaction_inventory";

    public function inventory()
    {
    	return $this->hasOne("App\Models\Inventory","id","inventory_id");
    }
    // public function inventory1()
    // {
    // 	return $this->hasOne("App\Models\Inventory","id","inventory_id");
    // }
}
