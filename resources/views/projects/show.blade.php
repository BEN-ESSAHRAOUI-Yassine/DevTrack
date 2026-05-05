@extends('layouts.app')

@section('page-title', 'Project Details')

@section('content')

{{-- MEMBERS SECTION --}}
<div class="mt-10 bg-white p-5 rounded-xl border">

    <h2 class="text-lg font-semibold mb-4">Members</h2>

    {{-- LIST MEMBERS --}}
    <div class="space-y-3">

        @foreach($project->users as $user)

        <div class="flex justify-between items-center border-b pb-2">

            <div>
                <p class="font-medium">{{ $user->name }}</p>
                <p class="text-xs text-gray-500">
                    {{ ucfirst($user->pivot->role) }}
                </p>
            </div>
            @can('manageMembers', $project)
            {{-- REMOVE BUTTON --}}
            @if(auth()->id() !== $user->id)
            <form method="POST"
                  action="{{ route('projects.members.remove', [$project, $user]) }}">
                @csrf
                @method('DELETE')

                <button class="text-red-500 text-sm">
                    Remove
                </button>
            </form>
            @endif
            @endcan
        </div>

        @endforeach

    </div>

    {{-- ADD MEMBER --}}
    <form method="POST"
          action="{{ route('projects.members.add', $project) }}"
          class="mt-6 flex gap-2">

        @csrf

        <input type="email"
               name="email"
               placeholder="User email"
               class="border px-3 py-2 rounded-lg w-full">

        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Add
        </button>

    </form>

</div>
<br><br>
<div class="flex justify-between items-start">

    <div>
        <h1 class="text-2xl font-bold">{{ $project->title }}</h1>

        <p class="text-gray-500 mt-2">
            {{ $project->description }}
        </p>
    </div>

    <div class="flex gap-2">

        {{-- Show Dashboard (Tasks page) --}}
        
        <a href="{{ route('projects.dashboard', $project) }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">
            Show Dashboard
        </a>

        {{-- Edit --}}
        @can('update', $project)
        <a href="{{ route('projects.edit', $project) }}"
           class="bg-gray-200 px-4 py-2 rounded-lg">
            Edit
        </a>
        
        {{-- Archive --}}
        <form method="POST"
              action="{{ route('projects.destroy', $project) }}">
            @csrf
            @method('DELETE')

            <button class="bg-red-500 text-white px-4 py-2 rounded-lg">
                Archive
            </button>
        </form>
        @endcan

    </div>

</div>

{{-- Optional meta section --}}
<div class="mt-6 text-sm text-gray-500">
    <p>Created at: {{ $project->created_at->format('Y-m-d') }}</p>
    <p>Tasks: {{ $project->tasks_count ?? $project->tasks->count() }}</p>
</div>

@endsection