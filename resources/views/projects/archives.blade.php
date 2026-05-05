@extends('layouts.app')

@section('page-title', 'Archived Projects')

@section('content')

<h1 class="text-2xl font-bold mb-6">Archived Projects</h1>

@forelse($archivedProjects as $project)

<div class="bg-white p-4 rounded-xl border mb-3 flex justify-between items-center">

    <span>{{ $project->title }}</span>

    <div class="flex gap-2">

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

</div>

@empty
<p>No archived projects</p>
@endforelse

@endsection