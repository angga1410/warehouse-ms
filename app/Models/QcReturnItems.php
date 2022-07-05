<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcReturnItems extends Model
{
    protected $table = "qc_return_items";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
}
