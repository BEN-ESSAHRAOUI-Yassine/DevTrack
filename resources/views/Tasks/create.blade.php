@extends('layouts.app')

@section('page-title', isset($task) ? 'Edit Task' : 'Create Task')

@section('content')

<div class="max-w-lg bg-white p-6 rounded-xl border shadow-sm">

<form method="POST"
      action="{{ isset($task)
        ? route('projects.tasks.update', [$project, $task])
        : route('projects.tasks.store', $project) }}">

    @csrf
    @if(isset($task)) @method('PUT') @endif

    <input name="title"
           value="{{ old('title', $task->title ?? '') }}"
           placeholder="Title"
           class="w-full border p-2 mb-3 rounded-lg">

    <textarea name="description"
              class="w-full border p-2 mb-3 rounded-lg">{{ old('description', $task->description ?? '') }}</textarea>

    <select name="status" class="w-full border p-2 mb-3 rounded-lg">
        <option value="todo">Todo</option>
        <option value="in_progress">In Progress</option>
        <option value="done">Done</option>
    </select>

    <select name="priority" class="w-full border p-2 mb-3 rounded-lg">
        <option value="low">Low</option>
        <option value="medium">Medium</option>
        <option value="high">High</option>
    </select>

    <input type="date" name="deadline"
           value="{{ old('deadline', $task->deadline ?? '') }}"
           class="w-full border p-2 mb-3 rounded-lg">

    <select name="assigned_user_id" class="w-full border p-2 mb-4 rounded-lg">
        @foreach($users as $user)
            <option value="{{ $user->id }}"
                {{ isset($task) && $task->assigned_user_id == $user->id ? 'selected' : '' }}>
                {{ $user->name }}
            </option>
        @endforeach
    </select>

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        Save Task
    </button>

</form>

</div>

@endsection