<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialRequest extends Model
{
    protected $table = "material_request";

    public function user()
    {
        return $this->belongsTo('App\User','requester_id');
    }
    public function materialrequest()
    {
        return $this->hasMany('App\Models\MaterialRequestItem');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier','source_id');
    }
}
