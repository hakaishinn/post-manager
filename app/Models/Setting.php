<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public function permalink(){
        return $this->belongsTo('App\Models\Permalink', 'permalink_id');
    }

    public function website(){
        return $this->hasOne('App\Models\Website');
    }
}
