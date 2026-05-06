@extends('layouts.app')

@section('page-title', isset($task) ? 'Edit Task' : 'Create Task')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ isset($task) ? 'Edit Task' : 'Create Task' }}
        </h1>
        <p class="text-sm text-gray-500">
            {{ isset($task)
                ? 'Update task details'
                : 'Create a new task for this project' }}
        </p>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white p-6 rounded-2xl border shadow-sm">

        <form method="POST"
              action="{{ route('projects.tasks.update', [$project, $task]) }}">

            @csrf
            @if(isset($task)) @method('PUT') @endif

            {{-- TITLE --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Title
                </label>

                <input name="title"
                       value="{{ old('title', $task->title ?? '') }}"
                       placeholder="Task title"
                       class="w-full border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('title')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DESCRIPTION --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          placeholder="Task description..."
                          class="w-full border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $task->description ?? '') }}</textarea>

                @error('description')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- STATUS + PRIORITY --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

                {{-- STATUS --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Status
                    </label>

                    <select name="status"
                            class="w-full border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                        @php $status = old('status', $task->status ?? 'todo'); @endphp

                        <option value="todo" {{ $status == 'todo' ? 'selected' : '' }}>Todo</option>
                        <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ $status == 'done' ? 'selected' : '' }}>Done</option>
                    </select>

                    @error('status')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- PRIORITY --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Priority
                    </label>

                    <select name="priority"
                            class="w-full border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                        @php $priority = old('priority', $task->priority ?? 'medium'); @endphp

                        <option value="low" {{ $priority == 'low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ $priority == 'medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ $priority == 'high' ? 'selected' : '' }}>High</option>
                    </select>

                    @error('priority')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- DEADLINE --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Deadline
                </label>

                <input type="date"
                       name="deadline"
                       value="{{ old('deadline', isset($task) && $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('Y-m-d') : '') }}"
                       class="w-full border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('deadline')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ASSIGNEE --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Assign To
                </label>

                <select name="assigned_to"
                        class="w-full border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="">Unassigned</option>

                    @foreach($developers as $user)
                        <option value="{{ $user->id }}"
                            {{ old('assigned_to', $task->assigned_to ?? '') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach

                </select>

                @error('assigned_to')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTIONS --}}
            <div class="flex justify-between items-center">

                <a href="{{ route('projects.tasks.index', $project) }}"
                   class="text-sm text-gray-500 hover:underline">
                    Cancel
                </a>

                <button class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                    {{ isset($task) ? 'Update Task' : 'Create Task' }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection