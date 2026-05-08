<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
   /**
    * Transform the resource into an array.
    */
   public function toArray(Request $request): array
   {
       return [
           'id' => $this->id,

           'title' => $this->title,

           'description' => $this->description,

           'deadline' => $this->deadline,

           'status' => $this->status,

           'tasks_count' => $this->tasks_count,

           'completed_tasks' => $this->tasks
               ->where('status', 'done')
               ->count(),

           'members_count' => $this->users_count,

           'created_at' => $this->created_at?->format('Y-m-d'),
       ];
   }
}
