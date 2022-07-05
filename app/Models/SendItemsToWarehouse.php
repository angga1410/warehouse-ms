<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendItemsToWarehouse extends Model
{
    protected $table = "send_items_to_warehouse";

    public function user()
    {
        return $this->belongsTo('App\User','handover_by_id');
    }
    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }
    public function document()
    {
        return $this->hasOne("App\Models\ReceiveReport","id","receive_report_id");
    }
}
