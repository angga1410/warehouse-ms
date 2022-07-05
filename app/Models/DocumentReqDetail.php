<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentReqDetail extends Model
{
    protected $table = "document_pick_detail";
    public function doc(){
        return $this->belongsTo('App\Models\DocumentPick');
    }
    public function item(){
        return $this
        ->hasOne('App\Models\ItemProduct','id','product_id');
        
    }
}
