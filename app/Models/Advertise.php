<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    use HasFactory;

    public function position()
    {
        return $this->belongsTo('App\Models\Position', 'position_id');
    }
    public function align()
    {
        return $this->belongsTo('App\Models\Align', 'align_id');
    }
    public function class()
    {
        return $this->belongsTo('App\Models\Classes', 'class_id');
    }
    public function website()
    {
        return $this->belongsTo('App\Models\Website', 'website_id');
    }
    public function statusCode()
    {
        return $this->belongsTo('App\Models\Status', 'status_id');
    }
    public function type()
    {
        return $this->belongsTo('App\Models\TypeOfAdvertise', 'type_id');
    }
    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }

    public function pages()
    {
        return $this->belongsToMany('App\Models\Page', 'advertise_page', 'advertise_id', 'page_id');
    }
}
