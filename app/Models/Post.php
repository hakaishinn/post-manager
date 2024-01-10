<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use HasFactory;

    public function website()
    {
        return $this->belongsTo('App\Models\Website', 'website_id');
    }

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

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_post', 'post_id', 'category_id');
    }
    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'post_tag', 'post_id', 'tag_id');
    }
    public function keywords()
    {
        return $this->belongsToMany('App\Models\Keyword', 'keyword_post', 'post_id', 'keyword_id');
    }
}
