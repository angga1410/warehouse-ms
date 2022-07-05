<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcReturnSerialNo extends Model
{
    protected $table = "qc_return_serial_no";

    public function qcReturnItems()
    {
        return $this->belongsTo('App\Models\QcReturnItems');
    }
    

}
