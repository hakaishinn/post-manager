<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
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

    public function technology()
    {
        return $this->belongsTo('App\Models\Technology', 'technology_id');
    }
    public function manager()
    {
        return $this->belongsTo('App\Models\User', 'manager_id');
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
    public function analytic()
    {
        return $this->belongsTo('App\Models\Analytic', 'analytic_id');
    }
    public function team()
    {
        return $this->belongsTo('App\Models\Team', 'team_id');
    }
    public function traffic()
    {
        return $this->belongsTo('App\Models\Traffic', 'traffic_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\Department', 'department_id');
    }
    public function server()
    {
        return $this->belongsTo('App\Models\Server', 'server_id');
    }
    public function setting()
    {
        return $this->belongsTo('App\Models\Setting', 'setting_id');
    }
    public function links()
    {
        return $this->hasMany('App\Models\Menu');
    }
    public function menu()
    {
        return $this->hasOne('App\Models\Menu');
    }
    public function page()
    {
        return $this->hasOne('App\Models\Page');
    }
    public function color()
    {
        return $this->hasOne('App\Models\Color');
    }
}
