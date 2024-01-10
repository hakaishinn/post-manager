<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiKey;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class ApiKeyController extends Controller
{
    public function createApiKey(Request $request)
    {
        $permissionId = Permission::all()->pluck('id');
        $username = $request->user()->username;
        $apiKey = ApiKey::where('name', $username)->first();
        if (!$apiKey) {
            Artisan::call('apikey:generate', ['name' => $username]);
            $apiKey = ApiKey::where('name', $username)->first();
            $apiKey->permissions()->sync($permissionId);
        }
        return response()->json([
            'name' => $apiKey->name ?? null,
            'key' => $apiKey->key ?? null,
        ]);
    }
}
