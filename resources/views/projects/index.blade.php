@extends('layouts.app')

@section('page-title', 'Projects')

@section('content')

<div class="flex justify-between mb-6">
    <h1 class="text-2xl font-bold">Projects</h1>

    <a href="{{ route('projects.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        + New Project
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($projects as $project)

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

    <a href="{{ route('projects.show', $project) }}"
       class="text-blue-600 mt-3 inline-block">
        View →
    </a>

</div>

@endforeach

</div>

@endsection