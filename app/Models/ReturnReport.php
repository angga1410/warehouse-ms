<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnReport extends Model
{
    protected $table = "return_report";

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function mover()
    {
        return $this->belongsTo('App\Models\Mover');
    }
    public function returndetail()
    {
        return $this->hasMany('App\Models\ReturnReportDetail');
    }

    
}
