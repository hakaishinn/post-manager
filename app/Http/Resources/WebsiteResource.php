<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebsiteResource extends JsonResource
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
            'domain' => $this->domain,
            'status_code' => $this->status_code,
            'status_name' => $this->status_name,
            'technology' => [
                'id' => $this->technology->id ?? 0,
                'name' => $this->technology->name ?? null,
            ],
            'manager' => [
                'id' => $this->manager->id ?? 0,
                'name' => $this->manager->name ?? null,
                'username' => $this->manager->username ?? null,
            ],
            'company' => [
                'id' => $this->company->id ?? 0,
                'name' => $this->company->name ?? null,
            ],
            'creater' => [
                'id' => $this->creater->id ?? 0,
                'name' => $this->creater->name ?? null,
                'username' => $this->creater->username ?? null,
            ],
            'updater' => [
                'id' => $this->updater->id ?? 0,
                'name' => $this->updater->name ?? null,
                'username' => $this->updater->username ?? null,
            ],
            'analytic' => [
                'tracking' => $this->analytic->tracking ?? null,
                'google_id' => $this->analytic->google_id ?? null,
                'ga4_property_id' => $this->analytic->ga4_property_id ?? null,
                'measurement_id' => $this->analytic->measurement_id ?? null,
            ],
            'team' => [
                'id' => $this->team->id ?? 0,
                'name' => $this->team->name ?? null,
            ],
            'traffic' => [
                'traffics_total' => $this->traffic->traffics_total,
                'class' => $this->traffic->class,
                'width' => $this->traffic->width,
            ],
            'department' => [
                'id' => $this->department->id ?? 0,
                'name' => $this->department->name ?? null,
            ],
            'analytic_code' => $this->analytic_code,
            'server' => [
                'id' => $this->server->id ?? 0,
                'ip_address' => $this->server->ip_address ?? null,
            ],
            'setting' => [
                'text_color' => $this->setting->text_color,
                'font_size' => $this->setting->font_size,
                'font_name' => $this->setting->font_name,
                'permalink' => [
                    'id' => $this->setting->permalink->id ?? 0,
                    'name' => $this->setting->permalink->name ?? null,
                ],
                'logo' => $this->setting->logo,
                'favicon' => $this->setting->favicon,
                'site_title' => $this->setting->site_title,
            ],
            'links' => $this->links->map(function($link){
                return [
                    'id' => $link->id,
                    'name' => $link->name,
                    'url' => $link->url,
                ];
            }),
            'meta' => $this->show_meta ? json_decode($this->meta, true) : '',
            'yoast-seo' => $this->show_meta ? json_decode($this->{'yoast-seo'}, true) : '',
        ];
    }
}
