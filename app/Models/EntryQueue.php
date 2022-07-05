<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntryQueue extends Model
{
    protected $table = "entry_queue";

    public function mover()
    {
        return $this->belongsTo('App\Models\Mover');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function entryqueuedetail()
    {
        return $this->hasMany('App\Models\EntryQueueDetail');
    }
}