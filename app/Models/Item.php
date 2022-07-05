<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";

    public function user()
    {
        return $this->belongsTo('App\User','receiver_id');
    }
    
    public function itemdetail()
    {
        return $this->hasMany('App\Models\ItemPartDetail');
    }
}
