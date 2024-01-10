<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $total_posts = count($this->postsCreated);
        $post_total_page = ceil($this->postsCreated->count() / $this->post_limit);
        $posts = $this->is_random_post ? $this->postsCreated->shuffle() : $this->postsCreated;
        $start = ($this->post_page - 1) * $this->post_limit;
        $posts = $posts->slice($start, $this->post_limit);
        return [
            'id' => $this->id,
            'username' => $this->username,
            'posts' => $this->show_posts ? PostCategoryResource::collection($posts) : [],
            'post_count_total' => $this->show_posts ? $total_posts : 0,
            'post_count_page' => $this->show_posts ? $post_total_page : 0,
            'meta' => $this->show_meta ? json_decode($this->meta, true) : '',
            'yoast-seo' => $this->show_meta ? json_decode($this->{'yoast-seo'}, true) : '',
        ];
    }
}
