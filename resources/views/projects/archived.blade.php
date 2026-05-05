@extends('layouts.app')

@section('page-title', 'Archived Projects')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Archived Projects</h1>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($projects as $project)

<div class="bg-white p-5 rounded-xl border shadow-sm">

    <h3 class="font-semibold">{{ $project->title }}</h3>

    <p class="text-sm text-gray-500 mt-1">
        {{ Str::limit($project->description, 80) }}
    </p>

    <div class="flex justify-between mt-4 text-sm">
        <span class="{{ $project->status == 'done'
            ? 'text-green-600'
            : 'text-yellow-600' }}">
            {{ $project->status }}
        </span>

        <span>{{ $project->tasks->count() }} tasks</span>
    </div>

    <form method="POST" action="{{ route('projects.restore', $project->id) }}">
        @csrf
        <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm">
            Restore
        </button>
    </form>

    <form method="POST" action="{{ route('projects.forceDelete', $project->id) }}">
        @csrf @method('DELETE')
        <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">
            Delete
        </button>
    </form>

</div>


@empty
    <div class="col-span-full p-5 bg-yellow-50 border border-yellow-200 rounded-xl text-yellow-700">
        No archived projects found.
    </div>
@endforelse
</div>

@endsection