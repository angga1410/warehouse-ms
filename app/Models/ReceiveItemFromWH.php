<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveItemFromWH extends Model
{
    protected $table = "receive_item_from_wh";

    public function receiveitemdetail()
    {
        return $this->belongsTo('App\Models\ReceiveItemFromWHDetail');
    }
    public function user()
    {
        return $this->belongsTo('App\User','received_by_id');
    }
    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }
}
