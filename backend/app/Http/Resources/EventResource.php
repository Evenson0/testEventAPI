<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'date' => optional($this->date)->toIso8601String(),
            'description' => $this->description,
            'commentsCount' => $this->whenCounted('comments'),
        ];
    }
}
