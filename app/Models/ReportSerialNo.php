<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportSerialNo extends Model
{
    protected $table = "report_serial_no";

    public function qcRequestItemParts()
    {
        return $this->belongsTo('App\Models\QcRequestItemParts');
    }


}
