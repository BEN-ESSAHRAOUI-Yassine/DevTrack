@extends('layouts.app')

@section('page-title', 'Project Details')

@section('content')

<h1 class="text-2xl font-bold">{{ $project->title }}</h1>

<p class="text-gray-500">{{ $project->description }}</p>

<a href="{{ route('projects.tasks.create',$project) }}"
   class="bg-blue-600 text-white px-4 py-2 rounded mt-4 inline-block">
    + Task
</a>

<div class="grid grid-cols-2 gap-4 mt-6">

@foreach($project->tasks as $task)

<div class="bg-white p-4 border rounded-xl">

    <h3>{{ $task->title }}</h3>

    <p class="text-sm text-gray-500">{{ $task->status_label }}</p>

    <p class="{{ $task->deadline_status == 'urgent' ? 'text-red-500' : 'text-gray-400' }}">
        {{ $task->deadline }}
    </p>

    <a href="{{ route('projects.tasks.edit',[$project,$task]) }}"
       class="text-blue-600 text-sm">
        Edit
    </a>

</div>

@endforeach

</div>

@endsection