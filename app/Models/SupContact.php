<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupContact extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'supplier_contact';

    protected $fillable = ['supplier_id', 'contact_name','contact_position','contact_hand_phone','contact_email','contact_website'];

    public $timestamps = true;
}
