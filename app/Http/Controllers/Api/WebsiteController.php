<?php

namespace App\Http\Controllers\Api;

use App\Enums\EApiKeyPermission;
use App\Enums\EHeader;
use App\Http\Controllers\Controller;
use App\Http\Resources\WebsiteResource;
use App\Models\Website;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index(Request $request)
    {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllWebsite)) {
            $websiteID = $request->header(EHeader::WebsiteID);
            $show_meta = false;

            $query_params = $request->query();

            $query = Website::query();

            if (isset($query_params['status'])) {
                $query->where('status', $query_params['status']);
            }

            if ($websiteID != null) {
                $query->where('id', $websiteID);
            }

            if (isset($query_params['get_meta']) && $query_params['get_meta'] == 1) {
                $show_meta = true;
            }

            $limit = isset($query_params['limit']) ? $query_params['limit'] : 50;
            $websites = $query->paginate($limit);

            foreach ($websites as $website) {
                $website->show_meta = $show_meta;
            }

            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . count($websites->items()) . '</span> bài viết',
                'data' => WebsiteResource::collection($websites),
                'all_websites_traffics' => 0
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
