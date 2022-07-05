<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaterialRequestItem extends Model
{
    protected $table = "material_request_item";

    public function products()
    {
        return $this->hasOne("App\Models\ItemProduct","id","product_id");
    }
    public function mr()
    {
        return $this->hasOne("App\Models\MaterialRequest","id","material_request_id");
    }
    public function stock()
    {
        return $this->hasOne("App\Models\Inventory","product_id","product_id");
    }
}
