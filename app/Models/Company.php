<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->hasMany('App\Models\Post');
    }
    public function categories()
    {
        return $this->hasMany('App\Models\Category');
    }
    public function tags()
    {
        return $this->hasMany('App\Models\Tag');
    }
    public function advertise()
    {
        return $this->hasOne('App\Models\Advertise');
    }

    public function website(){
        return $this->hasOne('App\Models\Website');
    }
    public function pages()
    {
        return $this->hasMany('App\Models\Page');
    }
}
