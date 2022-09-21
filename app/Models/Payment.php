<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class,'paid_by','id');
    }
}
