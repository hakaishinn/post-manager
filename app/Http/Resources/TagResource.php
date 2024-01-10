<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;

class TagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $posts = $this->is_random_post ? $this->posts->shuffle() : $this->posts;
        $start = ($this->post_page - 1) * $this->post_limit;
        $post_total_page = ceil($this->posts->count() / $this->post_limit);
        $posts = $posts->slice($start, $this->post_limit);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'body' => $this->show_body ? $this->body : '',
            'image' => $this->image,
            'status_name' => $this->status_name,
            'status_code' => $this->status_code,
            'publish' => $this->publish,
            'parent' => [
                'id' => $this->parent->id ?? 0,
                'name' => $this->parent->name ?? 'Không có',
                'cate_wp_id' => $this->cate_wp_id,
            ],
            'count_childrens' => count($this->childrens),
            'count_posts' => $this->show_posts ? count($this->posts) : 0,
            'count_notes' => 0,
            'website' => [
                'id' => $this->website->id,
                'name' => $this->website->name,
                'domain' => $this->website->domain,
            ],
            'company' => [
                'id' => $this->company->id,
                'name' => $this->company->name,
            ],
            'creater' => [
                'id' => $this->creater->id,
                'name' => $this->creater->name,
                'created' => Carbon::parse($this->created_at)->format('d/m/Y H:i'),
            ],
            'updater' => [
                'id' => $this->updater->id ?? 0,
                'name' => $this->updater->name ?? null,
                'updated' => Carbon::parse($this->updated_at)->format('d/m/Y H:i'),
            ],
            'childrens' => $this->childrens->map(function ($children) {
                return [
                    'id' => $children->id,
                    'name' => $children->name,
                    'cate_wp_id' => $children->cate_wp_id,
                ];
            }),
            'tag_wp_id' => $this->tag_wp_id,
            'posts' => $this->show_posts ? PostCategoryResource::collection($posts) : [],
            'post_count_total' => $this->show_posts ? count($this->posts) : 0,
            'post_count_page' => $this->show_posts ? $post_total_page : 0,
            'meta' => $this->show_meta ? json_decode($this->meta, true) : '',
            'yoast-seo' => $this->show_meta ? json_decode($this->{'yoast-seo'}, true) : '',
        ];
    }
}
