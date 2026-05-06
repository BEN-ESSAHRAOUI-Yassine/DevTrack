@extends('layouts.app')

@section('page-title', isset($project) ? 'Edit Project' : 'Create Project')

@section('content')

<div class="max-w-2xl mx-auto">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ isset($project) ? 'Edit Project' : 'Create Project' }}
        </h1>
        <p class="text-sm text-gray-500">
            {{ isset($project)
                ? 'Update your project details'
                : 'Fill in the details to create a new project' }}
        </p>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white p-6 rounded-2xl border shadow-sm">

        <form method="POST"
              action="{{ isset($project)
                ? route('projects.update', $project)
                : route('projects.store') }}">

            @csrf
            @if(isset($project)) @method('PUT') @endif

            {{-- TITLE --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Title
                </label>

                <input type="text"
                       name="title"
                       value="{{ old('title', $project->title ?? '') }}"
                       placeholder="Project title"
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
                          placeholder="Project description..."
                          class="w-full border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $project->description ?? '') }}</textarea>

                @error('description')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- DEADLINE --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Deadline
                </label>

                <input type="date"
                       name="deadline"
                       value="{{ old('deadline', isset($project) && $project->deadline ? \Carbon\Carbon::parse($project->deadline)->format('Y-m-d') : '') }}"
                       class="w-full border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                @error('deadline')
                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTIONS --}}
            <div class="flex justify-between items-center">

                <a href="{{ route('projects.index') }}"
                   class="text-sm text-gray-500 hover:underline">
                    Cancel
                </a>

                <button class="bg-blue-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                    {{ isset($project) ? 'Update Project' : 'Create Project' }}
                </button>

            </div>

        </form>

    </div>

</div>

@endsection