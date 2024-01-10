<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
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
            'background_color' => $this->background,
            'text_color' => $this->text,
            'status' => [
                'status_code' => $this->status->id ?? 0,
                'status_name' => $this->status->name ?? null,
            ],
            'website' => [
                'id' => $this->website->id ?? 0,
                'name' => $this->website->name ?? null,
            ],
            'menu' => [
                'id' => $this->menu->id ?? 0,
                'level' => $this->menu->level ?? 0,
                'name' => $this->menu->name ?? null,
            ],
            'count_notes' => 0,
            'creater' => [
                'id' => $this->creater->id ?? 0,
            ],
            'updater' => [
                'id' => $this->updater->id ?? 0,
            ],
        ];
    }
}
