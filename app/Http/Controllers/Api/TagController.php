<?php

namespace App\Http\Controllers\Api;

use App\Enums\EApiKeyPermission;
use App\Enums\EHeader;
use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllTag)) {
            $websiteID = $request->header(EHeader::WebsiteID);
            $show_body = false;
            $show_meta = false;
            $show_posts = false;
            $is_random_post = false;

            $query_params = $request->query();

            $query = Tag::query();

            if (isset($query_params['status'])) {
                $query->where('status', $query_params['status']);
            }
            if (isset($query_params['tag_id'])) {
                $query->where('id', $query_params['tag_id']);
                $show_body = true;
            }

            if ($websiteID != null) {
                $query->where('website_id', $websiteID);
            }

            if (isset($query_params['parent_id'])) {
                $query->where('parent_id', $query_params['parent_id']);
            }

            if (isset($query_params['tag_slug'])) {
                $query->where('slug', $query_params['tag_slug']);
            }

            //tag
            $size_page_tag = isset($query_params['limit']) ? $query_params['limit'] : 50;
            $tags = $query->paginate($size_page_tag);

            $tag_count_total = $tags->total();
            $tag_count_page = ceil($tag_count_total / $size_page_tag);

            // posts
            $post_limit = isset($query_params['post_limit']) ? $query_params['post_limit'] : 5;
            $post_page = isset($query_params['post_page']) ? $query_params['post_page'] : 1;

            if (isset($query_params['get_meta']) && $query_params['get_meta'] == 1) {
                $show_meta = true;
            }
            if (isset($query_params['get_posts']) && $query_params['get_posts'] == 1) {
                $show_posts = true;
            }
            if (isset($query_params['random']) && $query_params['random'] == 1) {
                $is_random_post = true;
            }
            foreach ($tags as $tag) {
                $tag->show_body = $show_body;
                $tag->show_meta = $show_meta;
                $tag->show_posts = $show_posts;
                $tag->post_page = $post_page;
                $tag->post_limit = $post_limit;
                $tag->is_random_post = $is_random_post;
            }

            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . count($tags->items()) . '</span> tag',
                'data' => TagResource::collection($tags),
                'post_count_total' => $tag_count_total,
                'post_count_page' => $tag_count_page
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
