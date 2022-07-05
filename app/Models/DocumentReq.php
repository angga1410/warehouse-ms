<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentReq extends Model
{
    protected $table = "document_pick";

    public function Employee()
    {
    	return $this->hasOne("App\Models\Employee","id","request_by");
    }
}
