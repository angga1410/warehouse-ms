<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendingDoItems extends Model
{
    protected $table = "send_do_items";

    public function doUser()
    {
        return $this->belongsTo('App\User','do_id');
    }
    public function handoverByUser()
    {
        return $this->belongsTo('App\User','handover_by_id');
    }
    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }
}
