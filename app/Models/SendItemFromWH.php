<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SendItemFromWH extends Model
{
    protected $table = "send_items_from_wh";

    public function sender()
    {
        return $this->belongsTo('App\User','sender_id');
    }
    public function handover()
    {
        return $this->belongsTo('App\User','handover_by_id');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Models\Warehouse','warehouse');
    }
    public function location()
    {
        return $this->belongsTo('App\Models\WarehouseLocation','location');
    }
}