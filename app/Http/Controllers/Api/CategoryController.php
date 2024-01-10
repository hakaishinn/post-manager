<?php

namespace App\Http\Controllers\Api;

use App\Enums\EApiKeyPermission;
use App\Enums\EHeader;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\ApiKeyService;

class CategoryController extends Controller
{
    public function index (Request $request) {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllCategory)){
            $websiteID = $request->header(EHeader::WebsiteID);
            $show_body = false;
            $show_meta = false;
            $show_posts = false;
            $is_random_post = false;
    
            $query_params = $request->query();
    
            $query = Category::query();
    
            if (isset($query_params['status'])) {
                $query->where('status', $query_params['status']);
            }
            if (isset($query_params['category_id'])) {
                $query->where('id', $query_params['category_id']);
                $show_body = true;
            }
    
            if ($websiteID != null) {
                $query->where('website_id', $websiteID);
            }
    
            if (isset($query_params['parent_id'])) {
                $query->where('parent_id', $query_params['parent_id']);
            }
            if (isset($query_params['display_home'])) {
                $query->where('display_home_id', $query_params['display_home']);
            }
            if (isset($query_params['get_posts']) && $query_params['get_posts'] == 1) {
                $show_posts = true;
            }
    
            if (isset($query_params['category_slug'])) {
                $query->where('slug', $query_params['category_slug']);
            }
    
            //category
            $size_page_category = isset($query_params['limit']) ? $query_params['limit'] : 50;
            $categories = $query->paginate($size_page_category);
    
            $categories_count_total = $categories->total();
            $categories_count_page = ceil($categories_count_total / $size_page_category);
    
            // posts
            $post_limit = isset($query_params['post_limit']) ? $query_params['post_limit'] : null;
            $post_page = isset($query_params['post_page']) ? $query_params['post_page'] : 1;

            $post_random_start = isset($query_params['post_random_start']) ? $query_params['post_random_start'] : null;
            $post_random_end = isset($query_params['post_random_end']) ? $query_params['post_random_end'] : null;
    
            if (isset($query_params['get_meta']) && $query_params['get_meta'] == 1) {
                $show_meta = true;
            }
            if (isset($query_params['random']) && $query_params['random'] == 1) {
                $is_random_post = true;
            }
            foreach ($categories as $category) {
                $category->show_body = $show_body;
                $category->show_meta = $show_meta;
                $category->show_posts = $show_posts;
                $category->post_page = $post_page;
                $category->post_limit = $post_limit;
                $category->is_random_post = $is_random_post;
                $category->post_random_start = $post_random_start;
                $category->post_random_end = $post_random_end;
            }
    
            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . count($categories->items()) . '</span> thể loại',
                'data' => CategoryResource::collection($categories),
                'post_count_total' => $categories_count_total,
                'post_count_page' => $categories_count_page
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
