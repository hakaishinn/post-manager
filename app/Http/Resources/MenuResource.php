<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuResource extends JsonResource
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
            'url' => $this->url,
            'target' => $this->target,
            'icon' => $this->icon,
            'class_name' => $this->class_name,
            'level' => $this->type->level ?? 0,
            'status' => [
                'status_code' => $this->status->id ?? 0,
                'status_name' => $this->status->name ?? null,
            ],
            'type' => [
                'id' => $this->type->id ?? 0,
                'name' => $this->type->name ?? null,
                'background_color' => $this->type->background_color ?? null,
                'text_color' => $this->type->text_color ?? null,
            ],
            'website' => [
                'id' => $this->website->id ?? 0,
                'name' => $this->website->name ?? null,
            ],
            'parent' => [
                'id' => $this->parent->id ?? 0,
                'name' => $this->parent->name ?? 'Không có',
            ],
            'childrens' => $this->childrens->map(function ($children){
                return [
                    'id' => $children->id,
                    'name' => $children->name,
                ];
            }),
            'count_notes' => 0,
            'brand' => [
                'id' => $this->brand->id ?? 0,
                'name' => $this->brand->name ?? null,
            ],
            'creater' => [
                'id' => $this->creater->id ?? 0,
            ],
            'updater' => [
                'id' => $this->updater->id ?? 0
            ],
        ];
    }
}
