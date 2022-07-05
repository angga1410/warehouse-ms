<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreItemRequest extends Model
{
    protected $table = "store_item_request";

    public function user()
    {
        return $this->belongsTo('App\User','requester_id');
    }
    public function storeitemrequestitem()
    {
        return $this->hasMany('App\Models\StoreItemRequestItem');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','source_id');
    }
}
