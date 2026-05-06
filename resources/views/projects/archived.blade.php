@extends('layouts.app')

@section('page-title', 'Archived Projects')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">Archived Projects</h1>
        <p class="text-sm text-gray-500">
            Restore or permanently delete archived projects
        </p>
    </div>

    <a href="{{ route('projects.index') }}"
       class="text-sm text-blue-600 hover:underline">
        ← Back to Projects
    </a>

</div>

{{-- PROJECTS GRID --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($projects as $project)

<div class="bg-white p-5 rounded-2xl border shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200">

    {{-- TITLE --}}
    <h3 class="font-semibold text-gray-800 text-lg">
        {{ $project->title }}
    </h3>

    {{-- DESCRIPTION --}}
    <p class="text-sm text-gray-500 mt-1">
        {{ $project->description 
            ? Str::limit($project->description, 80) 
            : 'No description provided' }}
    </p>

    {{-- META --}}
    <div class="flex justify-between items-center mt-4 text-xs">

        {{-- STATUS BADGE --}}
        <span class="px-2 py-1 rounded-full font-medium
            {{ $project->status == 'done'
                ? 'bg-green-100 text-green-700'
                : 'bg-yellow-100 text-yellow-700' }}">
            {{ ucfirst($project->status) }}
        </span>

        {{-- TASK COUNT --}}
        <span class="text-gray-400">
            {{ $project->tasks_count ?? $project->tasks->count() }} tasks
        </span>

    </div>

    {{-- DEADLINE --}}
    @if($project->deadline)
        <p class="text-xs mt-2 text-gray-400">
            ⏰ {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
        </p>
    @endif

    {{-- ACTIONS --}}
    <div class="mt-5 flex justify-between items-center">

        {{-- RESTORE --}}
        <form method="POST"
              action="{{ route('projects.restore', $project->id) }}"
              onsubmit="return confirm('Restore this project?')">
            @csrf
            <button class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Restore
            </button>
        </form>

        {{-- DELETE --}}
        <form method="POST"
              action="{{ route('projects.forceDelete', $project->id) }}"
              onsubmit="return confirm('This will permanently delete the project. Continue?')">
            @csrf
            @method('DELETE')
            <button class="px-3 py-1.5 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                Delete
            </button>
        </form>

    </div>

</div>

@empty

<div class="col-span-full flex flex-col items-center justify-center py-12">

    <div class="text-5xl mb-3">🗂️</div>

    <p class="text-gray-500 mb-3">
        No archived projects found
    </p>

    <a href="{{ route('projects.index') }}"
       class="text-blue-600 text-sm hover:underline">
        Back to active projects
    </a>

</div>

@endforelse

</div>

@endsection