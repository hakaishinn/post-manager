<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisplayHome extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasOne('App\Models\Category');
    }
}
