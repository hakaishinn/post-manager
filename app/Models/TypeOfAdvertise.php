<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfAdvertise extends Model
{
    use HasFactory;

    protected $table = 'type_of_advertises';
    public function advertise()
    {
        return $this->hasOne('App\Models\Advertise');
    }
}
