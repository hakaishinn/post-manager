<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public function status(){
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function type(){
        return $this->belongsTo('App\Models\TypeOfMenu', 'type_id');
    }
    public function website(){
        return $this->belongsTo('App\Models\Website', 'website_id');
    }
    public function parent(){
        return $this->belongsTo('App\Models\Menu', 'parent_id');
    }
    public function childrens(){
        return $this->hasMany('App\Models\Menu', 'parent_id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }
    public function creater(){
        return $this->belongsTo('App\Models\User', 'creater_id');
    }
    public function updater(){
        return $this->belongsTo('App\Models\User', 'updater_id');
    }
    public function color()
    {
        return $this->hasOne('App\Models\Color');
    }
}
