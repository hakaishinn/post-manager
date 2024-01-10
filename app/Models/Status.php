<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public function advertise()
    {
        return $this->hasOne('App\Models\Advertise');
    }
    public function menu()
    {
        return $this->hasOne('App\Models\Menu');
    }
    public function page()
    {
        return $this->hasOne('App\Models\Page', 'status_id');
    }
    public function color()
    {
        return $this->hasOne('App\Models\Color');
    }
}
