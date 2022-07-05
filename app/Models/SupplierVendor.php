<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierVendor extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'supplier';

  
    public $timestamps = true;

    public function details(){
    	return $this->hasMany('App\Models\PODetail','pos_id','id');
    }
}
