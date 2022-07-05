<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcReturn extends Model
{
    protected $table = "qc_return";

    public function supplier()
    {
        return $this->belongsTo('App\User','supplier_id');
    }
    public function mover()
    {
        return $this->belongsTo('App\Models\Mover','mover_id');
    }
    public function retirndetail()
    {
    	return $this->hasMany('App\Models\QcReturnItems');
    }
}
