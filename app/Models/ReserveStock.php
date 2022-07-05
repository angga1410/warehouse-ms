<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReserveStock extends Model
{
    protected $connection = 'mysql';
    protected $table = 'reserve_stock';


    public $timestamps = true;

    public function reserve()
    {
        return $this->hasMany('App\Models\Inventory');
    }
    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
}
