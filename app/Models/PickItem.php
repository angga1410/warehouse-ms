<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PickItem extends Model
{
    protected $table = "pick_item";

    public function pickitemdetail()
    {
        return $this->hasMany('App\Models\PickItemDetail');
    }
    public function user()
    {
        return $this->belongsTo('App\User','pick_by_id');
    }
}
