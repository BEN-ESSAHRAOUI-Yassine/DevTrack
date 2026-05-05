@extends('layouts.app')

@section('page-title', 'Manage Members')

@section('content')

<div class="max-w-2xl">

    <h1 class="text-xl font-bold mb-4">Project Members</h1>

    {{-- Add member --}}
    <form method="POST" action="{{ route('projects.members.add', $project) }}"
          class="flex gap-2 mb-6">
        @csrf

        <input type="email" name="email" placeholder="Enter user email"
               class="flex-1 border p-2 rounded-lg">

        <button class="bg-blue-600 text-white px-4 rounded-lg">
            Add
        </button>
    </form>

    {{-- Members list --}}
    <div class="space-y-3">

        @foreach($project->users as $user)

        <div class="bg-white border rounded-xl p-3 flex justify-between items-center">

            <div>
                <p class="font-medium">{{ $user->name }}</p>
                <p class="text-sm text-gray-500">{{ $user->email }}</p>
            </div>

            <form method="POST"
                  action="{{ route('projects.members.remove', [$project, $user]) }}">
                @csrf
                @method('DELETE')

                <button class="text-red-500 text-sm">
                    Remove
                </button>
            </form>

        </div>

        @endforeach

    </div>

</div>

@endsection