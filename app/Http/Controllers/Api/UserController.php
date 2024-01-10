<?php

namespace App\Http\Controllers\Api;

use App\Enums\EApiKeyPermission;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorResource;
use App\Models\User;
use App\Services\ApiKeyService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (ApiKeyService::checkPermission($request->header(EApiKeyPermission::key), EApiKeyPermission::showAllAuthor)) {

            $show_posts = false;
            $is_random_post = false;

            $query_params = $request->query();

            $query = User::query();

            if (isset($query_params['status'])) {
                $query->where('status', $query_params['status']);
            }
            if (isset($query_params['author_id'])) {
                $query->where('id', $query_params['author_id']);
            }

            if (isset($query_params['get_posts']) && $query_params['get_posts'] == 1) {
                $show_posts = true;
            }
            if (isset($query_params['random']) && $query_params['random'] == 1) {
                $is_random_post = true;
            }

            $limit = isset($query_params['limit']) ? $query_params['limit'] : 50;
            $authors = $query->paginate($limit);

            $post_limit = isset($query_params['post_limit']) ? $query_params['post_limit'] : 5;
            $post_page = isset($query_params['post_page']) ? $query_params['post_page'] : 1;

            foreach ($authors as $author) {
                $author->show_posts = $show_posts;
                $author->post_page = $post_page;
                $author->post_limit = $post_limit;
                $author->is_random_post = $is_random_post;
            }

            return response()->json([
                'status_code' => 1,
                'message' => 'Có tất cả <span class=\"badge bg-primary\">' . count($authors->items()) . '</span> authors',
                'data' => AuthorResource::collection($authors),
            ]);
        } else {
            return redirect()->route('unauthorized');
        }
    }
}
