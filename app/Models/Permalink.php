<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permalink extends Model
{
    use HasFactory;

    public function setting(){
        return $this->hasOne('App\Models\Setting');
    }
}
