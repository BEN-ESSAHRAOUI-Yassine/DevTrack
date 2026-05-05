@extends('layouts.app')

@section('page-title', isset($project) ? 'Edit Project' : 'Create Project')

@section('content')

<div class="max-w-lg bg-white p-6 rounded-xl border shadow-sm">

<form method="POST"
      action="{{ isset($project)
        ? route('projects.update', $project)
        : route('projects.store') }}">

    @csrf
    @if(isset($project)) @method('PUT') @endif

    <input type="text" name="title"
           value="{{ old('title', $project->title ?? '') }}"
           placeholder="Title"
           class="w-full border p-2 mb-3 rounded-lg">

    <textarea name="description"
              placeholder="Description"
              class="w-full border p-2 mb-3 rounded-lg">{{ old('description', $project->description ?? '') }}</textarea>

    <input type="date" name="deadline"
           value="{{ old('deadline', $project->deadline ?? '') }}"
           class="w-full border p-2 mb-4 rounded-lg">

    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        {{ isset($project) ? 'Update' : 'Create' }}
    </button>

</form>

</div>

@endsection