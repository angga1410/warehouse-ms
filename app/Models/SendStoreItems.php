<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendStoreItems extends Model
{
    protected $table = "send_store_items";

     public function user()
    {
        return $this->belongsTo('App\User','handover_by_id');
    }
    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }
}
