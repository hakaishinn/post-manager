<?php

namespace App\Http\Controllers\Api;

use App\Enums\EApiKeyPermission;
use App\Enums\EHeader;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use App\Models\Page;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(Request $request)
    {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllPage)) {
            $websiteID = $request->header(EHeader::WebsiteID);
            $show_meta = false;

            $query_params = $request->query();

            $query = Page::query();

            if (isset($query_params['slug'])) {
                $query->where('slug', $query_params['slug']);
            }

            if (isset($query_params['node_id'])) {
                $query->where('id', $query_params['node_id']);
            }

            if ($websiteID != null) {
                $query->where('website_id', $websiteID);
            }

            if (isset($query_params['get_meta']) && $query_params['get_meta'] == 1) {
                $show_meta = true;
            }

            $limit = isset($query_params['limit']) ? $query_params['limit'] : 50;
            $pages = $query->paginate($limit);

            $total_count = $pages->total();
            $total_page = ceil($total_count / $limit);

            foreach ($pages as $page) {
                $page->show_meta = $show_meta;
            }

            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . count($pages->items()) . '</span> trang',
                'data' => PageResource::collection($pages),
                'total_count' => $total_count,
                'total_page' => $total_page,
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
