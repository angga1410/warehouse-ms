<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficialReport extends Model
{
    protected $table = "official_report";

    public function Employee()
    {
    	return $this->hasOne("App\Models\Employee","id","created_by");
    }
}
