<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
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

    public function website()
    {
        return $this->belongsTo('App\Models\Website', 'website_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Models\Tag', 'parent_id');
    }

    public function childrens()
    {
        return $this->hasMany('App\Models\Tag', 'parent_id');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post', 'post_tag', 'tag_id', 'post_id');
    }
}
