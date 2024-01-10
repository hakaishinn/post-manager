<?php

namespace App\Http\Controllers\Api;

use App\Services\ApiKeyService;
use App\Enums\EApiKeyPermission;
use App\Enums\EHeader;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Website;

class PostController extends Controller
{
    public function index(Request $request)
    {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllPost)) {
            $websiteID = $request->header(EHeader::WebsiteID);

            $show_body = false;
            $show_meta = false;

            $query_params = $request->query();

            $query = Post::query();

            if (isset($query_params['random']) && $query_params['random'] == 1) {
                $posts = $query->inRandomOrder();
            }

            if (isset($query_params['status'])) {
                $query->where('status', $query_params['status']);
            }
            if (isset($query_params['post_id'])) {
                $query->where('id', $query_params['post_id']);
                $show_body = true;
            }

            if ($websiteID != null) {
                $query->where('website_id', $websiteID);
            }

            if (isset($query_params['keywords'])) {
                $keywords = $query_params['keywords'];

                $query->whereHas('keywords', function ($query) use ($keywords) {
                    $query->whereRaw("'$keywords' LIKE CONCAT('%', name, '%')");
                });
            }
            if (isset($query_params['category_id'])) {
                $category_id = $query_params['category_id'];

                $query->whereHas('categories', function ($query) use ($category_id) {
                    $query->where('category_id', $category_id);
                });
            }
            if (isset($query_params['tag_id'])) {
                $tag_id = $query_params['tag_id'];

                $query->whereHas('tags', function ($query) use ($tag_id) {
                    $query->where('tag_id', $tag_id);
                });
            }
            if (isset($query_params['creater_id'])) {
                $query->where('creater_id', $query_params['creater_id']);
            }
            if (isset($query_params['updater_id'])) {
                $query->where('updater_id', $query_params['updater_id']);
            }
            if (isset($query_params['post_slug'])) {
                $query->where('slug', $query_params['post_slug']);
            }

            $limit = isset($query_params['limit']) ? $query_params['limit'] : 50;
            $page = isset($query_params['page']) ? $query_params['page'] : 1;

            $postsCountTotal = $query->get()->count();
            $postsCountPage = ceil($postsCountTotal / $limit);
            // pagination
            $start = ($page - 1) * $limit;
            $posts = $query->offset($start)->limit($limit)->get();

            if (isset($query_params['get_meta']) && $query_params['get_meta'] == 1) {
                $show_meta = true;
            }
            foreach ($posts as $post) {
                $post['show_body'] = $show_body;
                $post['show_meta'] = $show_meta;
            }


            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . $posts->count() . '</span> bài viết',
                'data' => PostResource::collection($posts),
                'post_count_total' => $postsCountTotal,
                'post_count_page' => $postsCountPage
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
