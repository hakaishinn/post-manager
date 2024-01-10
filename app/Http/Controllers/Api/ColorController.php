<?php

namespace App\Http\Controllers\Api;

use App\Enums\EApiKeyPermission;
use App\Enums\EHeader;
use App\Http\Controllers\Controller;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllColor)) {
            $websiteID = $request->header(EHeader::WebsiteID);
            $query_params = $request->query();

            $query = Color::query();

            if (isset($query_params['status'])) {
                $query->where('status', $query_params['status']);
            }

            if ($websiteID != null) {
                $query->where('website_id', $websiteID);
            }
            if (isset($query_params['menu_id'])) {
                $query->where('menu_id', $query_params['menu_id']);
            }
            if (isset($query_params['color_id'])) {
                $query->where('id', $query_params['color_id']);
            }

            if (isset($query_params['level'])) {
                $level = $query_params['level'];

                $query->whereHas('menu', function ($query) use ($level) {
                    $query->where('level', $level);
                });
            }

            $limit = isset($query_params['limit']) ? $query_params['limit'] : 50;
            $colors = $query->paginate($limit);

            $total_count = $colors->total();

            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . count($colors->items()) . '</span> màu',
                'data' => ColorResource::collection($colors),
                'count_colors' => $total_count
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
