<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdvertiseResource extends JsonResource
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
            'body' => $this->body,
            'position' => [
                'id' => $this->position->id ?? 0,
                'name' => $this->position->name ?? null,
            ],
            'align' => [
                'id' => $this->align->id ?? 0,
                'name' => $this->align->name ?? 'Mặc định',
            ],
            'class' => [
                'name' => $this->class->name,
                'number' => $this->class->number,
                'repeat_content_number' => $this->class->repeat_content_number,
            ],
            'delay_time' => $this->delay_time,
            'pages' => $this->pages->map(function ($page){
                return [
                    'id' => $page->id,
                    'name' => $page->name,
                ];
            }),
            'website' => [
                'id' => $this->website->id ?? 0,
                'name' => $this->website->name ?? null,
            ],
            'status' => [
                'code' => $this->statusCode->id ?? 0,
                'name' => $this->statusCode->name ?? null,
            ],
            'type' => [
                'id' => $this->type->id ?? 0,
                'name' => $this->type->name ?? null,
            ],
            'company' => [
                'id' => $this->company->id ?? 0,
            ],
        ];
    }
}
