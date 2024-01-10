<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostCategoryResource extends JsonResource
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
            'description' => $this->description,
            'created' => Carbon::parse($this->created_at)->format('d/m/Y H:i'),
            'image' => $this->image,
            'author' => [
                'id' => $this->creater->id,
                'name' => $this->creater->name,
                'username' => $this->creater->username,
            ]
        ];
    }
}
