<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveReport extends Model
{
    protected $table = "receive_report";

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function document()
    {
        return $this->hasOne("App\Models\ReceiveDocument","id","document_no");
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
