<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeOfMenu extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->hasOne('App\Models\Menu', 'type_id');
    }
}
