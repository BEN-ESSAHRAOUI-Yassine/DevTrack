@extends('layouts.app')

@section('page-title', 'Projects')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">Projects</h1>
        <p class="text-sm text-gray-500">
            Manage and track all your active projects
        </p>
    </div>

    <a href="{{ route('projects.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition text-sm">
        + New Project
    </a>

</div>

{{-- STATS (optional but powerful) --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-sm text-gray-500">Total</p>
        <p class="text-xl font-bold">{{ $projects->count() }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-sm text-gray-500">Completed</p>
        <p class="text-xl font-bold text-green-600">
            {{ $projects->where('status', 'done')->count() }}
        </p>
    </div>

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-sm text-gray-500">Pending</p>
        <p class="text-xl font-bold text-yellow-600">
            {{ $projects->where('status', 'pending')->count() }}
        </p>
    </div>

</div>

{{-- PROJECTS GRID --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($projects as $project)

<div class="bg-white p-5 rounded-2xl border shadow-sm hover:shadow-md transition">

    {{-- Title --}}
    <h3 class="font-semibold text-gray-800">
        {{ $project->title }}
    </h3>

    {{-- Description --}}
    <p class="text-sm text-gray-500 mt-1">
        {{ Str::limit($project->description, 80) }}
    </p>

    {{-- Meta --}}
    <div class="flex justify-between items-center mt-4 text-xs">

        {{-- STATUS BADGE --}}
        <span class="px-2 py-1 rounded-full text-xs font-medium
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
        Deadline: {{ \Carbon\Carbon::parse($project->deadline)->format('d M Y') }}
    </p>
    @endif

    {{-- ACTION --}}
    <div class="mt-4 flex justify-between items-center">

        <a href="{{ route('projects.show', $project) }}"
           class="text-blue-600 text-sm hover:underline">
            View details →
        </a>

        {{-- Quick status indicator --}}
        <span class="text-xs text-gray-400">
            {{ $project->tasks->where('status','done')->count() }}/{{ $project->tasks->count() }}
        </span>

    </div>

</div>

@empty

<div class="col-span-full flex flex-col items-center justify-center py-12">

    <div class="text-5xl mb-3">📂</div>

    <p class="text-gray-500 mb-3">
        No projects yet
    </p>

    <a href="{{ route('projects.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
        Create your first project
    </a>

</div>

@endforelse

</div>

@endsection