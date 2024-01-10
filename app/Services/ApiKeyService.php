<?php

namespace App\Services;
use App\Models\ApiKey;

class ApiKeyService {
    public static function checkPermission($key, $permission){
        $isHasPermission = false;
        $apiKey = ApiKey::where('key', $key)->first();
        $isHasPermission = $apiKey->permissions->map(function ($permission){
            return $permission->slug;
        })->contains($permission);
        
        return $isHasPermission;
    }
}