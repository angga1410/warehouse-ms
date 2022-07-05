<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackingItems extends Model
{
    protected $table = "packing_items";

    public function packingdetail()
    {
        return $this->hasMany('App\Models\PackingItemDetail');
    }

    public function doUser()
    {
        return $this->belongsTo('App\User','do_id');
    }
    public function packByUser()
    {
        return $this->belongsTo('App\User','pack_by_id');
    }
    
}
