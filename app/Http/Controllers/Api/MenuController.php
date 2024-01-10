<?php

namespace App\Http\Controllers\Api;

use App\Enums\EApiKeyPermission;
use App\Enums\EHeader;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllMenu)) {
            $websiteID = $request->header(EHeader::WebsiteID);
            $query_params = $request->query();

            $query = Menu::query();

            if (isset($query_params['status'])) {
                $query->where('status', $query_params['status']);
            }
            if ($websiteID != null) {
                $query->where('website_id', $websiteID);
            }
            if (isset($query_params['link_id'])) {
                $query->where('id', $query_params['link_id']);
            }
            if (isset($query_params['parent_id'])) {
                $query->where('parent_id', $query_params['parent_id']);
            }

            if (isset($query_params['menu_id'])) {
                $query->where('type_id', $query_params['menu_id']);
            }
            if (isset($query_params['level'])) {
                $level = $query_params['level'];

                $query->whereHas('type', function ($query) use ($level) {
                    $query->where('level', $level);
                });
            }

            $limit = isset($query_params['limit']) ? $query_params['limit'] : 50;
            $menus = $query->paginate($limit);

            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . count($menus->items()) . '</span> menu',
                'data' => MenuResource::collection($menus)
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
