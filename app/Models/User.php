<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function postsCreated()
    {
        return $this->hasMany('App\Models\Post', 'creater_id');
    }
    public function postsUpdated()
    {
        return $this->hasMany('App\Models\Post', 'updater_id');
    }

    public function categoriesCreated()
    {
        return $this->hasMany('App\Models\Category', 'creater_id');
    }
    public function categoriesUpdated()
    {
        return $this->hasMany('App\Models\Category', 'updater_id');
    }
    public function tagsCreated()
    {
        return $this->hasMany('App\Models\Tag', 'creater_id');
    }
    public function tagsUpdated()
    {
        return $this->hasMany('App\Models\Tag', 'updater_id');
    }

    public function websitesManager(){
        return $this->hasMany('App\Models\Website', 'manager_id');
    }
    public function websitesCreated(){
        return $this->hasMany('App\Models\Website', 'creater_id');
    }
    public function websitesUpdated(){
        return $this->hasMany('App\Models\Website', 'updater_id');
    }
    public function menusCreated(){
        return $this->hasMany('App\Models\Menu', 'creater_id');
    }
    public function menusUpdated(){
        return $this->hasMany('App\Models\Menu', 'updater_id');
    }
    public function pagesCreated(){
        return $this->hasMany('App\Models\Page', 'creater_id');
    }
    public function pagesUpdated(){
        return $this->hasMany('App\Models\Page', 'updater_id');
    }
    public function colorsCreated(){
        return $this->hasMany('App\Models\Color', 'creater_id');
    }
    public function colorsUpdated(){
        return $this->hasMany('App\Models\Color', 'updater_id');
    }

    public function roles() {
        return $this->belongsToMany('App\Models\Role', 'role_users', 'user_id', 'role_id');
    }
}