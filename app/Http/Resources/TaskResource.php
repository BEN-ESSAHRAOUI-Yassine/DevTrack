<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'status_label' => $this->status_label, // accessor
            'priority' => $this->priority,
            'deadline' => optional($this->deadline)->toDateTimeString(),
            'deadline_status' => $this->deadline_status, // accessor
            'assigned_to' => [
                'id' => $this->assignedUser?->id,
                'name' => $this->assignedUser?->name,
                'email' => $this->assignedUser?->email,
            ],
            'created_at' => optional($this->created_at)->toDateTimeString(),
            'updated_at' => optional($this->updated_at)->toDateTimeString(),
        ];
    }
}
