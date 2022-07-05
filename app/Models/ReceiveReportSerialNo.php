<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveReportSerialNo extends Model
{
    protected $table = "receive_report_serial_no";

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function mover()
    {
        return $this->belongsTo('App\Models\Mover');
    }
     public function supplier()
    {
        return $this->belongsTo('App\Models\SupplierVendor','source_id');
    }
    public function reportdetail()
    {
        return $this->hasMany('App\Models\ReceiveReportDetail');
    }
}
