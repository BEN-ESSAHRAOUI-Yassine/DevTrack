@extends('layouts.app')

@section('page-title', 'Tasks')

@section('content')

@php use Illuminate\Support\Str; @endphp

<div class="flex justify-between items-center mb-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $project->title }} : Tasks
        </h1>
        <p class="text-sm text-gray-500">Manage tasks for this project</p>
    </div>

    @can('create', [App\Models\Task::class, $project])
    <a href="{{ route('projects.tasks.create', $project) }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
        + New Task
    </a>
    @endcan

</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

@foreach($tasks as $task)

<div class="bg-white p-5 rounded-2xl border shadow-sm
    {{ $task->assigned_to === auth()->id() ? 'ring-2 ring-blue-400' : '' }}">

    {{-- TITLE --}}
    <h3 class="font-semibold text-gray-800 text-lg">
        {{ $task->title }}
    </h3>

    {{-- DESCRIPTION --}}
    <p class="text-sm text-gray-500 mt-1">
        {{ $task->description ? Str::limit($task->description, 70) : 'No description' }}
    </p>

    {{-- STATUS + PRIORITY --}}
    <div class="flex justify-between mt-4 text-xs">

        <span class="px-2 py-1 rounded-full
            {{ $task->status == 'done' ? 'bg-green-100 text-green-700' :
               ($task->status == 'in_progress' ? 'bg-yellow-100 text-yellow-700' :
               'bg-gray-100 text-gray-600') }}">
            {{ $task->status_label }}
        </span>

        <span class="px-2 py-1 rounded-full
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

    {{-- ASSIGNED USER --}}
    <div class="mt-3 flex items-center justify-between">

        <div class="text-xs">
            <span class="text-gray-400">Assigned to:</span>
            <span class="font-medium text-gray-700">
                {{ $task->assignedUser->name ?? 'Unassigned' }}
            </span>
        </div>

        {{-- MY TASK BADGE --}}
        @if($task->assigned_to === auth()->id())
            <span class="text-xs bg-blue-100 text-blue-600 px-2 py-1 rounded-full">
                My Task
            </span>
        @endif

    </div>

    {{-- ACTIONS --}}
    <div class="mt-4 flex justify-between items-center">

        {{-- STATUS CHANGE --}}
        @if(
            auth()->id() === $task->assigned_to ||
            auth()->user()->projects->find($project->id)->pivot->role === 'lead'
        )

        <form method="POST"
              action="{{ route('projects.tasks.updateStatus', [$project, $task]) }}">
            @csrf
            @method('PATCH')

            <select name="status"
                    onchange="this.form.submit()"
                    class="text-xs border rounded px-2 py-1">

                <option value="todo" {{ $task->status=='todo'?'selected':'' }}>Todo</option>
                <option value="in_progress" {{ $task->status=='in_progress'?'selected':'' }}>In Progress</option>
                <option value="done" {{ $task->status=='done'?'selected':'' }}>Done</option>

            </select>

        </form>

        @endif

        {{-- LEAD ACTIONS --}}
        @can('update', $task)
        <div class="flex gap-2">

            <a href="{{ route('projects.tasks.edit', [$project, $task]) }}"
               class="text-blue-600 text-xs">Edit</a>

            <form method="POST"
                  action="{{ route('projects.tasks.destroy', [$project, $task]) }}">
                @csrf
                @method('DELETE')

                <button class="text-red-500 text-xs">Delete</button>
            </form>

        </div>
        @endcan

    </div>

</div>

@endforeach

</div>

@endsection