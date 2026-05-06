@extends('layouts.app') 

@section('page-title', 'Tasks')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">Tasks</h1>
        <p class="text-sm text-gray-500">
            Manage tasks for this project
        </p>
    </div>

    <a href="{{ route('tasks.create', $project) }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
        + New Task
    </a>

</div>

{{-- STATS --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-xs text-gray-500">Total</p>
        <p class="text-lg font-bold">{{ $tasks->count() }}</p>
    </div>

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-xs text-gray-500">Done</p>
        <p class="text-lg font-bold text-green-600">
            {{ $tasks->where('status','done')->count() }}
        </p>
    </div>

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-xs text-gray-500">In Progress</p>
        <p class="text-lg font-bold text-yellow-600">
            {{ $tasks->where('status','in_progress')->count() }}
        </p>
    </div>

    <div class="bg-white p-4 rounded-xl border text-center">
        <p class="text-xs text-gray-500">Pending</p>
        <p class="text-lg font-bold text-gray-600">
            {{ $tasks->where('status','pending')->count() }}
        </p>
    </div>

</div>

{{-- TASK GRID --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@forelse($tasks as $task)

<div class="bg-white p-5 rounded-2xl border shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-200">

    {{-- TITLE --}}
    <h3 class="font-semibold text-gray-800 text-lg">
        {{ $task->title }}
    </h3>

    {{-- DESCRIPTION --}}
    <p class="text-sm text-gray-500 mt-1">
        {{ $task->description 
            ? Str::limit($task->description, 70) 
            : 'No description' }}
    </p>

    {{-- META --}}
    <div class="flex justify-between items-center mt-4 text-xs">

        {{-- STATUS --}}
        <span class="px-2 py-1 rounded-full font-medium
            {{ $task->status == 'done' ? 'bg-green-100 text-green-700' :
               ($task->status == 'in_progress' ? 'bg-yellow-100 text-yellow-700' :
               'bg-gray-100 text-gray-600') }}">
            {{ ucfirst(str_replace('_',' ', $task->status)) }}
        </span>

        {{-- PRIORITY --}}
        <span class="px-2 py-1 rounded-full text-xs
            {{ $task->priority == 'high' ? 'bg-red-100 text-red-600' :
               ($task->priority == 'medium' ? 'bg-yellow-100 text-yellow-600' :
               'bg-gray-100 text-gray-600') }}">
            {{ ucfirst($task->priority) }}
        </span>

    </div>

    {{-- DEADLINE --}}
    @if($task->deadline)
    <p class="text-xs mt-2
        {{ $task->deadline_status == 'urgent'
            ? 'text-red-500 font-semibold'
            : 'text-gray-400' }}">
        ⏰ {{ \Carbon\Carbon::parse($task->deadline)->format('d M Y') }}
    </p>
    @endif

    {{-- FOOTER --}}
    <div class="mt-4 flex justify-between items-center">

        {{-- ASSIGNEE --}}
        <span class="text-xs text-gray-400">
            {{ $task->user->name ?? 'Unassigned' }}
        </span>

        {{-- ACTION --}}
        <a href="{{ route('tasks.edit', [$project, $task]) }}"
           class="text-blue-600 text-sm hover:underline">
            Edit →
        </a>

    </div>

</div>

@empty

<div class="col-span-full flex flex-col items-center justify-center py-12">

    <div class="text-5xl mb-3">📝</div>

    <p class="text-gray-500 mb-3">
        No tasks yet
    </p>

    <a href="{{ route('tasks.create', $project) }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm">
        Create your first task
    </a>

</div>

@endforelse

</div>

@endsection