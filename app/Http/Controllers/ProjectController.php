<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $projects = auth()->user()
            ->projects()
            ->with(['tasks'])
            ->get();

        $archivedProjects = auth()->user()
            ->projects()
            ->onlyTrashed()
            ->get();

        $leadprojects = auth()->user()
            ->projects()
            ->wherePivot('role', 'lead')
            ->with('tasks')
            ->get();

        return view('projects.index', compact('projects','archivedProjects','leadprojects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        // Attach creator as lead
        $project->users()->attach(auth()->id(), ['role' => 'lead']);

        return redirect()->route('projects.index')
            ->with('success', 'Project created');
    }

    public function show(Project $project)
    {
        $this->authorize('view', $project);

        $project->load(['tasks.user', 'users']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validated());

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project archived');
    }

    // Archive = SoftDelete already handled by destroy()

    public function archive(Project $project)
    {
        $this->authorize('archive', $project);

        $project->delete();

        return back()->with('success', 'Project archived');
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        $this->authorize('restore', $project);

        $project->restore();

        return back()->with('success', 'Project restored');
    }

    public function forceDelete($id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        $this->authorize('forceDelete', $project);

        $project->forceDelete();

        return back()->with('success', 'Project permanently deleted');
    }

    // Members

    public function addMember(Request $request, Project $project)
    {
        $this->authorize('manageMembers', $project);

        $user = User::where('email', $request->email)->firstOrFail();

        $project->users()->syncWithoutDetaching([
            $user->id => ['role' => 'developer']
        ]);

        return back()->with('success', 'Member added');
    }

    public function removeMember(Project $project, User $user)
    {
        $this->authorize('manageMembers', $project);

        $project->users()->detach($user->id);

        return back()->with('success', 'Member removed');
    }
}