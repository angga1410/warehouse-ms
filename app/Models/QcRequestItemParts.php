<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QcRequestItemParts extends Model
{
    protected $table = "qc_request_item_parts";

    public function products()
    {
    	return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
}
