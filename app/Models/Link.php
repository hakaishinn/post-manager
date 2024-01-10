<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    public function website(){
        return $this->belongsTo('App\Models\Website', 'link_id');
    }
}
