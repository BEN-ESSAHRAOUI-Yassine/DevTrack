<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectApiController extends Controller
{
   public function index()
   {
       $projects = Project::query()
           ->with(['tasks', 'users'])
           ->withCount(['tasks', 'users'])
           ->latest()
           ->get();

       return ProjectResource::collection($projects);
   }
}
