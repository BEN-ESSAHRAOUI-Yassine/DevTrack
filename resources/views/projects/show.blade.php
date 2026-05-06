@extends('layouts.app')

@section('page-title', 'Project Details')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $project->title }}
        </h1>

        <p class="text-gray-500 mt-1">
            {{ $project->description ?: 'No description provided' }}
        </p>
    </div>

    {{-- ACTIONS --}}
    <div class="flex flex-wrap gap-2">

        <a href="{{ route('projects.dashboard', $project) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
            Dashboard
        </a>

        @can('update', $project)
        <a href="{{ route('projects.edit', $project) }}"
           class="bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200 text-sm">
            Edit
        </a>

        <form method="POST"
              action="{{ route('projects.destroy', $project) }}"
              onsubmit="return confirm('Archive this project?')">
            @csrf
            @method('DELETE')

            <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 text-sm">
                Archive
            </button>
        </form>
        @endcan

    </div>

</div>

{{-- META STATS --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-xs text-gray-500">Tasks</p>
        <p class="text-lg font-bold">
            {{ $project->tasks_count ?? $project->tasks->count() }}
        </p>
    </div>

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-xs text-gray-500">Completed</p>
        <p class="text-lg font-bold text-green-600">
            {{ $project->completed_tasks_count ?? $project->tasks->where('status','done')->count() }}
        </p>
    </div>

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-xs text-gray-500">Members</p>
        <p class="text-lg font-bold">
            {{ $project->users->count() }}
        </p>
    </div>

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-xs text-gray-500">Created</p>
        <p class="text-sm font-medium">
            {{ $project->created_at->format('d M Y') }}
        </p>
    </div>

</div>

{{-- MAIN GRID --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- MEMBERS --}}
    <div class="lg:col-span-1 bg-white p-5 rounded-2xl border shadow-sm">

        <h2 class="text-lg font-semibold mb-4">Members</h2>

        <div class="space-y-3">

            @foreach($project->users as $user)

            <div class="flex justify-between items-center border-b pb-2">

                <div>
                    <p class="font-medium text-gray-800">{{ $user->name }}</p>
                    <p class="text-xs text-gray-500">
                        {{ ucfirst($user->pivot->role) }}
                    </p>
                </div>

                @can('manageMembers', $project)
                @if(auth()->id() !== $user->id)

                <form method="POST"
                      action="{{ route('projects.members.remove', [$project, $user]) }}"
                      onsubmit="return confirm('Remove this member?')">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-500 text-xs hover:underline">
                        Remove
                    </button>
                </form>

                @endif
                @endcan

            </div>

            @endforeach

        </div>

        {{-- ADD MEMBER --}}
        @can('manageMembers', $project)
        <form method="POST"
              action="{{ route('projects.members.add', $project) }}"
              class="mt-5 flex gap-2">

            @csrf

            <input type="email"
                   name="email"
                   placeholder="Invite by email"
                   class="border px-3 py-2 rounded-lg w-full text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                Add
            </button>

        </form>
        @endcan

    </div>

    {{-- RIGHT SIDE (FUTURE: TASKS / ACTIVITY / STATS) --}}
    <div class="lg:col-span-2 bg-white p-5 rounded-2xl border shadow-sm flex items-center justify-center text-gray-400">

        <p class="text-sm">
            Project activity, tasks, or analytics can go here
        </p>

    </div>

</div>

@endsection