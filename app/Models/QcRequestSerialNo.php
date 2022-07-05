<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcRequestSerialNo extends Model
{
    protected $table = "qc_request_serial_no";

    public function qcRequestItemParts()
    {
        return $this->belongsTo('App\Models\QcRequestItemParts');
    }
    

}
