<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemsReq extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'items_req';

    protected $fillable = ['mfr', 'part_num', 'part_name', 'part_desc', 'default_um', 'status' ];

    public $timestamps = true;
}
