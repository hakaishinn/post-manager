<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $categories = $this->categories->map(function ($item) {
            return [
                'id'=> $item->id,
                'name'=> $item->name,
                'cate_wp_id'=> $item->cate_wp_id,
                'slug'=> $item->slug,
            ];
        });
        $tags = $this->tags->map(function ($item) {
            return [
                'id'=> $item->id,
                'name'=> $item->name,
                'slug'=> $item->slug,
                'tag_wp_id'=> $item->tag_wp_id,
            ];
        });
        $keywords = $this->keywords->map(function ($item) {
            return [
                'name'=> $item->name,
            ];
        });


        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'body' => $this->show_body ? $this->body : '',
            'image' => $this->image,
            'image_name' => $this->image_name,
            'website' => [
                'id' => $this->website->id,
                'name' => $this->website->name,
                'domain' => $this->website->domain,
            ],
            'company' => [
                'id' => $this->company->id,
                'name' => $this->company->name,
            ],
            'categories' =>  $categories,
            'tags' => $tags,
            'creater' => [
                'id' => $this->creater->id,
                'name' => $this->creater->name,
                'username' => $this->creater->username,
                'created' => Carbon::parse($this->created_at)->format('d/m/Y H:i'),
            ],
            'updater' => [
                'id' => $this->updater->id ?? 0,
                'name' => $this->updater->name ?? null,
                'username' => $this->updater->username ?? null,
                'updated' => Carbon::parse($this->updated_at)->format('d/m/Y H:i') ?? null,
            ],
            'post_wp_id' => $this->post_wp_id,
            'url' => $this->website->domain.$this->id,
            'keywords' => $keywords,
            'meta' => $this->show_meta ? json_decode($this->meta, true) : '',
            'yoast-seo' => $this->show_meta ? json_decode($this->{'yoast-seo'}, true) : '',
        ];
    }
}
