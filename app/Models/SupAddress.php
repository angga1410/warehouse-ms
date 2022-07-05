<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupAddress extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'supplier_address';

    protected $fillable = ['supplier_id', 'address_line_1','address_line_2','address_line_3','post_code','city','province_id','country_id','phone','fax','email'];

    public $timestamps = true;
}
