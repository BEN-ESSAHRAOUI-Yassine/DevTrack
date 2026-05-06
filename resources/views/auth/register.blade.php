@extends('layouts.app')

@section('content')

<div class="min-h-[70vh] flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl border shadow-sm">

        {{-- Title --}}
        <h1 class="text-2xl font-bold mb-2 text-center">Create account</h1>
        <p class="text-sm text-gray-500 text-center mb-6">
            Join DevTrack and start managing your projects
        </p>

        {{-- Errors --}}
        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <label class="text-sm text-gray-600">Name</label>
            <input type="text" name="name" required
                   value="{{ old('name') }}"
                   class="w-full border p-2 mb-4 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

            {{-- Email --}}
            <label class="text-sm text-gray-600">Email</label>
            <input type="email" name="email" required
                   value="{{ old('email') }}"
                   class="w-full border p-2 mb-4 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

            {{-- Password --}}
            <label class="text-sm text-gray-600">Password</label>
            <input type="password" name="password" required
                   class="w-full border p-2 mb-4 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

            {{-- Confirm Password --}}
            <label class="text-sm text-gray-600">Confirm Password</label>
            <input type="password" name="password_confirmation" required
                   class="w-full border p-2 mb-6 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

            {{-- Submit --}}
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Create Account
            </button>

        </form>

        {{-- Divider --}}
        <div class="text-center text-sm text-gray-400 my-4">
            already have an account?
        </div>

        {{-- Login CTA --}}
        <a href="{{ route('login') }}"
           class="block w-full text-center border py-2 rounded-lg hover:bg-gray-50">
            Login
        </a>

    </div>

</div>

@endsection