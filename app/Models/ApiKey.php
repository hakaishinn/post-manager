<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiKey extends Model
{
    use HasFactory;
    protected $table = 'api_keys';

    public function permissions() {
        return $this->belongsToMany('App\Models\Permission', 'api_key_permissions', 'api_key_id', 'permission_id')->withTimestamps();
    }
}
