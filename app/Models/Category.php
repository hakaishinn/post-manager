<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function creater()
    {
        return $this->belongsTo('App\Models\User', 'creater_id');
    }
    public function updater()
    {
        return $this->belongsTo('App\Models\User', 'updater_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Category', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\Category', 'parent_id');
    }

    public function website()
    {
        return $this->belongsTo('App\Models\Website', 'website_id');
    }
    public function displayHome()
    {
        return $this->belongsTo('App\Models\DisplayHome', 'display_home_id');
    }
    public function color()
    {
        return $this->belongsTo('App\Models\Color', 'color_id');
    }
    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'category_post', 'category_id', 'post_id');
    }
}
