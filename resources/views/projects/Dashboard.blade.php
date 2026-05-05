@extends('layouts.app')

@section('page-title', 'Tasks')

@section('content')

<div class="flex justify-between items-center mb-6">

    <h1 class="text-2xl font-bold">Tasks</h1>

    <a href="{{ route('tasks.create', $project) }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
        + Task
    </a>

</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

@foreach($tasks as $task)

<div class="bg-white p-4 rounded-xl border shadow-sm">

    <h3 class="font-semibold">{{ $task->title }}</h3>

    <p class="text-sm text-gray-500 mt-1">
        {{ Str::limit($task->description, 60) }}
    </p>

    <div class="flex justify-between items-center mt-3 text-xs">

        {{-- STATUS --}}
        <span class="px-2 py-1 rounded
            {{ $task->status == 'done' ? 'bg-green-100 text-green-700' :
               ($task->status == 'in_progress' ? 'bg-yellow-100 text-yellow-700' :
               'bg-gray-100 text-gray-600') }}">
            {{ $task->status_label }}
        </span>

        {{-- PRIORITY --}}
        <span class="text-gray-500">
            {{ ucfirst($task->priority) }}
        </span>

    </div>

    {{-- DEADLINE --}}
    <p class="text-xs mt-2
        {{ $task->deadline_status == 'urgent'
            ? 'text-red-500 font-semibold'
            : 'text-gray-400' }}">
        {{ $task->deadline }}
    </p>

    <div class="flex justify-between mt-3 text-sm">

        <span class="text-gray-400">
            {{ $task->user->name ?? 'N/A' }}
        </span>

        <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
           class="text-blue-600">
            Edit
        </a>

    </div>

</div>

@endforeach

</div>

@endsection