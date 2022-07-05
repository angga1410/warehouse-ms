<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialReportDetail extends Model
{
    protected $table = "official_report_detail";
    public function doc(){
        return $this->belongsTo('App\Models\OfficialReport');
    }
    public function item(){
        return $this
        ->hasOne('App\Models\ItemProduct','id','product_id');
        
    }
}
