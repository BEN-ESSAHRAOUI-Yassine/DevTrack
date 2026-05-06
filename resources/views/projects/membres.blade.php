@extends('layouts.app')

@section('page-title', 'Manage Members')

@section('content')

<div class="max-w-3xl mx-auto">

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manage Members</h1>
            <p class="text-sm text-gray-500">
                Add or remove people from this project
            </p>
        </div>

        <a href="{{ route('projects.show', $project) }}"
           class="text-sm text-blue-600 hover:underline">
            ← Back to Project
        </a>
    </div>

    {{-- ADD MEMBER --}}
    <div class="bg-white p-5 rounded-2xl border shadow-sm mb-6">

        <h2 class="text-sm font-semibold text-gray-700 mb-3">
            Invite Member
        </h2>

        <form method="POST"
              action="{{ route('projects.members.add', $project) }}"
              class="flex gap-2">

            @csrf

            <input type="email"
                   name="email"
                   placeholder="Enter user email"
                   class="flex-1 border px-3 py-2 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                Add
            </button>

        </form>

    </div>

    {{-- MEMBERS LIST --}}
    <div class="bg-white p-5 rounded-2xl border shadow-sm">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-sm font-semibold text-gray-700">
                Members ({{ $project->users->count() }})
            </h2>
        </div>

        <div class="space-y-3">

            @forelse($project->users as $user)

            <div class="flex justify-between items-center border-b pb-3">

                <div class="flex items-center gap-3">

                    {{-- AVATAR --}}
                    <div class="w-9 h-9 rounded-full bg-gray-200 flex items-center justify-center text-sm font-medium text-gray-600">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    {{-- USER INFO --}}
                    <div>
                        <p class="font-medium text-gray-800">
                            {{ $user->name }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $user->email }}
                        </p>
                    </div>

                </div>

                {{-- ACTION --}}
                @if(auth()->id() !== $user->id)
                <form method="POST"
                      action="{{ route('projects.members.remove', [$project, $user]) }}"
                      onsubmit="return confirm('Remove this member?')">
                    @csrf
                    @method('DELETE')

                    <button class="text-red-500 text-xs hover:underline">
                        Remove
                    </button>
                </form>
                @else
                    <span class="text-xs text-gray-400">You</span>
                @endif

            </div>

            @empty

            <div class="text-center py-6 text-gray-400 text-sm">
                No members yet
            </div>

            @endforelse

        </div>

    </div>

</div>

@endsection