<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiveItems extends Model
{
    protected $table = "receive_items";

    public function receiveitemsdetail()
    {
        return $this->hasMany('App\Models\ReceiveItemsDetail');
    }
    public function user()
    {
        return $this->belongsTo('App\User','received_by_id');
    }
    public function sender()
    {
    	 return $this->belongsTo('App\User','sender_id');
    }
    public function document()
    {
        return $this->hasOne("App\Models\ReceiveDocument","id","document_no");
    }
    public function rr()
    {
        return $this->hasOne("App\Models\ReceiveReport","id","reference_id");
    }
}
