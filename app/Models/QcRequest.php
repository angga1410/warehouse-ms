<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcRequest extends Model
{
    protected $table = "qc_request";

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function document()
    {
        return $this->hasOne("App\Models\ReceiveDocument","id","document_no");
    }
    public function entryQueue()
    {
        return $this->belongsTo('App\Models\EntryQueue');
    }
    public function qcrequestitems()
    {
        return $this->hasMany('App\Models\QcRequestItemParts');
    }
}


