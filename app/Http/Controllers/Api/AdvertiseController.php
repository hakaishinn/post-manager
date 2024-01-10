<?php

namespace App\Http\Controllers\Api;

use App\Enums\EApiKeyPermission;
use App\Enums\EHeader;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertiseResource;
use App\Models\Advertise;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;

class AdvertiseController extends Controller
{
    public function index(Request $request)
    {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllAdvertise)) {
            $websiteID = $request->header(EHeader::WebsiteID);

            $query_params = $request->query();
            $query = Advertise::query();

            if (isset($query_params['status'])) {
                $query->where('status', $query_params['status']);
            }

            if ($websiteID != null) {
                $query->where('website_id', $websiteID);
            }

            if (isset($query_params['advertise_id'])) {
                $query->where('id', $query_params['advertise_id']);
            }
            if (isset($query_params['position_id'])) {
                $query->where('position_id', $query_params['position_id']);
            }
            if (isset($query_params['align_id'])) {
                $query->where('align_id', $query_params['align_id']);
            }
            if (isset($query_params['type_id'])) {
                $query->where('type_id', $query_params['type_id']);
            }

            if (isset($query_params['pages'])) {
                $page_id = $query_params['pages'];

                $query->whereHas('pages', function ($query) use ($page_id) {
                    $query->where('page_id', $page_id);
                });
            }
            $limit = isset($query_params['limit']) ? $query_params['limit'] : 50;

            $advertiseCountTotal = $query->get()->count();
            $advertiseCountPage = ceil($advertiseCountTotal / $limit);

            $advertises = $query->paginate($limit);

            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . count($advertises->items()) . '</span> quảng cáo',
                'data' => AdvertiseResource::collection($advertises),
                'post_count_total' => $advertiseCountTotal,
                'post_count_page' => $advertiseCountPage
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
