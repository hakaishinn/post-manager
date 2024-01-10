<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    public function categories()
    {
        return $this->hasOne('App\Models\Category');
    }
    public function status()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function website()
    {
        return $this->belongsTo('App\Models\Website', 'website_id');
    }
    public function menu()
    {
        return $this->belongsTo('App\Models\TypeOfMenu', 'menu_id');
    }
    public function creater()
    {
        return $this->belongsTo('App\Models\User', 'creater_id');
    }
    public function updater()
    {
        return $this->belongsTo('App\Models\User', 'updater_id');
    }
}
