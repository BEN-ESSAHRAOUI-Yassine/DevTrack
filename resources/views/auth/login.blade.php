@extends('layouts.app')

@section('content')

<div class="min-h-[70vh] flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-2xl border shadow-sm">

        {{-- Title --}}
        <h1 class="text-2xl font-bold mb-2 text-center">Welcome back</h1>
        <p class="text-sm text-gray-500 text-center mb-6">
            Login to your DevTrack account
        </p>

        {{-- Errors --}}
        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <label class="text-sm text-gray-600">Email</label>
            <input type="email" name="email" required
                   class="w-full border p-2 mb-4 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

            {{-- Password --}}
            <label class="text-sm text-gray-600">Password</label>
            <input type="password" name="password" required
                   class="w-full border p-2 mb-4 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">

            {{-- Remember + Forgot --}}
            <div class="flex justify-between items-center mb-4 text-sm">

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>

                <a href="#" class="text-blue-600 hover:underline">
                    Forgot?
                </a>

            </div>

            {{-- Login Button --}}
            <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>

        </form>

        {{-- Divider --}}
        <div class="text-center text-sm text-gray-400 my-4">
            or
        </div>

        {{-- Register CTA --}}
        <a href="{{ route('register') }}"
           class="block w-full text-center border py-2 rounded-lg hover:bg-gray-50">
            Create an account
        </a>

    </div>

</div>

@endsection