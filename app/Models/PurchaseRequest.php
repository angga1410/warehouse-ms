<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'purchase_request';
    protected $fillable = ['id','pr_number','pr_number_seq','qs_id','pr_date','pr_target','job_id','request_from','request_mode','pr_dept', 'pr_reference_type ', 'pr_reference_id ', 'pr_requester_id ','purpose','purpose_remark', 'status', 'approved_by', 'approved_date', 'created_by', 'modified_by', 'created_at', 'updated_at'];

    public $timestamps = true;

    public function details()
    {
        return $this->hasMany('App\Models\PRDetail','pr_id');
    }
}
