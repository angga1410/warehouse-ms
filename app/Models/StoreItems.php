<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreItems extends Model
{
    protected $table = "store_items";

    public function storeitemsdetail()
    {
        return $this->hasMany('App\Models\StoreItemsDetail');
    }
    public function user()
    {
        return $this->belongsTo('App\User','storer_id');
    }
    
}
