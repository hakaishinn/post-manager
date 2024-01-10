<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $limit = $this->post_limit ? $this->post_limit : $this->quantity_post;
        if($this->post_random_start && $this->post_random_end){
            $limit = random_int($this->post_random_start, $this->post_random_end);
        }
        $total_posts = count($this->posts);
        $post_total_page = ceil($this->posts->count() / $limit);
        $posts = $this->is_random_post ? $this->posts->shuffle() : $this->posts;
        $start = ($this->post_page - 1) * $limit;
        $posts = $posts->slice($start, $limit);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'layout_name' => $this->layout_name,
            'quantity_post' => $this->quantity_post,
            'slug' => $this->slug,
            'description' => $this->description,
            'body' => $this->show_body ? $this->body : '',
            'image' => $this->image,
            'status_name' => $this->status_name,
            'status_code' => $this->status_code,
            'publish' => $this->publish,
            'cate_wp_id' => $this->cate_wp_id,
            'company' => [
                'id' => $this->company->id ?? 0,
                'name' => $this->company->name ?? null,
            ],
            'creater' => [
                'id' => $this->creater->id ?? 0,
                'name' => $this->creater->name ?? null,
                'created' => Carbon::parse($this->created_at)->format('d/m/Y H:i'),
            ],
            'updater' => [
                'id' => $this->updater->id ?? 0,
                'name' => $this->updater->name ?? null,
                'updated' => Carbon::parse($this->updated_at)->format('d/m/Y H:i'),
            ],
            'parent' => [
                'id' => $this->parent->id ?? 0,
                'name' => $this->parent->name ?? 'Không có',
                'cate_wp_id' => $this->cate_wp_id,
            ],
            'count_notes' => 0,
            'count_childrens' => count($this->childrens),
            'count_posts' => $this->show_posts ? $total_posts : 0,
            'website' => [
                'id' => $this->website->id ?? 0,
                'name' => $this->website->name ?? null,
                'domain' => $this->website->domain ?? null,
            ],
            'childrens' => $this->childrens->map(function ($children) {
                return [
                    'id' => $children->id,
                    'name' => $children->name,
                    'cate_wp_id' => $children->cate_wp_id,
                ];
            }),
            'display_home' => [
                'id' => $this->displayHome->id ?? 0,
                'name' => $this->displayHome->name ?? 'No',
            ],
            'color' => [
                'background' => $this->color->background ?? null,
                'text' => $this->color->text ?? null,
            ],
            'posts' => $this->show_posts ? PostCategoryResource::collection($posts) : [],
            'post_count_total' => $this->show_posts ? $total_posts : 0,
            'post_count_page' => $this->show_posts ? $post_total_page : 0,
            'meta' => $this->show_meta ? json_decode($this->meta, true) : '',
            'yoast-seo' => $this->show_meta ? json_decode($this->{'yoast-seo'}, true) : '',
        ];
    }
}
