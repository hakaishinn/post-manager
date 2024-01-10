<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'slug' => $this->slug,
            'description' => $this->description,
            'body' => $this->body,
            'image' => $this->image,
            'status' => [
                'id' => $this->statusPage->id ?? 0,
                'name' => $this->statusPage->name ?? null,
            ],
            'website' => [
                'id' => $this->website->id ?? 0,
                'name' => $this->website->name ?? null,
                'domain' => $this->website->domain ?? null,
            ],
            'creater' => [
                'id' => $this->creater->id ?? 0,
                'name' => $this->creater->name ?? null,
                'created' => $this->created_at,
            ],
            'updater' => [
                'id' => $this->updater->id ?? 0,
                'name' => $this->updater->name ?? null,
                'updated' => $this->updated_at,
            ],
            'company' => [
                'id' => $this->company->id ?? 0,
            ],
            'count_notes' => 0,
            'meta' => $this->show_meta ? json_decode($this->meta, true) : "",
            'yoast-seo' => $this->show_meta ? json_decode($this->{'yoast-seo'}, true) : "",
        ];
    }
}
