<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    public function adversises()
    {
        return $this->belongsToMany('App\Models\Advertise', 'advertise_page', 'page_id', 'advertise_id');
    }

    public function statusPage(){
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function website(){
        return $this->belongsTo('App\Models\Website', 'website_id');
    }
    public function creater(){
        return $this->belongsTo('App\Models\User', 'creater_id');
    }
    public function updater(){
        return $this->belongsTo('App\Models\User', 'updater_id');
    }
    public function company(){
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
