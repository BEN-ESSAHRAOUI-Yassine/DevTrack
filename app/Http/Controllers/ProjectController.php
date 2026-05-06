<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Requests\AddProjectMemberRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ProjectController extends Controller
{
    use AuthorizesRequests;

    /**
     * Active projects (Lead + Dev)
     */
    public function index()
    {
        $projects = auth()->user()
            ->projects()
            ->withCount('tasks')
            ->get();

        return view('projects.index', compact('projects'));
    }

    /**
     * My own projects (Lead only)
     */
    public function mine()
    {
        $projects = auth()->user()
            ->projects()
            ->wherePivot('role', 'lead')
            ->withCount('tasks')
            ->get();

        return view('projects.mine', compact('projects'));
    }

    /**
     * Archived projects (Soft Deleted)
     */
    public function archived()
    {
        $projects = auth()->user()
            ->projects()
            ->onlyTrashed()
            ->withCount('tasks')
            ->get();

        return view('projects.archived', compact('projects'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store new project
     */
    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());

        // Attach creator as lead
        $project->users()->attach(auth()->id(), [
            'role' => 'lead'
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project created');
    }

    /**
     * Show project
     */
    public function show(Project $project)
    {
        $this->authorize('view', $project);

        // $project->load([
        //     'tasks.user',
        //     'users'
        // ]);

        $project->loadCount('tasks');

        return view('projects.show', compact('project'));
    }

    public function Dashboard(Project $project)
    {
        $this->authorize('view', $project);

        $project->load([
            'tasks.assignedUser',
            'users'
        ]);

        return view('projects.Dashboard', compact('project'));
    }

    /**
     * Edit form
     */
    public function edit(Project $project)
    {
        $this->authorize('update', $project);

        return view('projects.edit', compact('project'));
    }

    /**
     * Update project
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($request->validated());

        return redirect()->route('projects.show', $project)
            ->with('success', 'Project updated');
    }

    /**
     * Archive (Soft Delete)
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project archived');
    }

    /**
     * Restore project
     */
    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        $this->authorize('restore', $project);

        $project->restore();

        return back()->with('success', 'Project restored');
    }

    /**
     * Permanently delete
     */
    public function forceDelete($id)
    {
        $project = Project::withTrashed()->findOrFail($id);

        $this->authorize('forceDelete', $project);

        $project->forceDelete();

        return back()->with('success', 'Project permanently deleted');
    }

    /**
     * Add member to project
     */
    public function addMember(AddProjectMemberRequest $request, Project $project)
    {
        $this->authorize('manageMembers', $project);

        $user = User::where('email', $request->email)->first();

        if ($project->users()->where('user_id', $user->id)->exists()) {
            return back()->with('info', 'User is already in the project');
        }

        // ✅ Attach if not exists
        $project->users()->attach($user->id, [
            'role' => 'developer'
        ]);

        return back()->with('success', 'Member added');
    }

    /**
     * Remove member
     */
    public function removeMember(Project $project, User $user)
    {
        $this->authorize('manageMembers', $project);

        $authUser = auth()->user();

        // Get the member with pivot role
        $member = $project->users()
            ->where('user_id', $user->id)
            ->first();

        if (!$member) {
            return back()->with('error', 'User is not a member of this project');
        }

        $role = $member->pivot->role;

        //  Only rule: lead cannot remove himself
        if ($user->id === $authUser->id && $role === 'lead') {
            return back()->with('error', 'You cannot remove yourself as a lead');
        }

        //  Otherwise allow removal
        $project->tasks()
        ->where('assigned_to', $user->id)
        ->update(['assigned_to' => null]);
        $project->users()->detach($user->id);
        

        return back()->with('success', 'Member removed');
    }
}