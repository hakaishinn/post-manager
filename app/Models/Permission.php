<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public function apiKeys() {
        return $this->belongsToMany('App\Models\ApiKey', 'api_key_permissions', 'permission_id', 'api_key_id');
    }
}
