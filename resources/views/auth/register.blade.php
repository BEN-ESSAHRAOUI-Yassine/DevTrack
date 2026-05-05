@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded-xl border shadow-sm">

    <h1 class="text-xl font-bold mb-4">Register</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="text" name="name" placeholder="Name"
               class="w-full border p-2 mb-3 rounded-lg">

        <input type="email" name="email" placeholder="Email"
               class="w-full border p-2 mb-3 rounded-lg">

        <input type="password" name="password" placeholder="Password"
               class="w-full border p-2 mb-3 rounded-lg">

        <input type="password" name="password_confirmation"
               placeholder="Confirm Password"
               class="w-full border p-2 mb-4 rounded-lg">

        <button class="w-full bg-blue-600 text-white py-2 rounded-lg">
            Create Account
        </button>

    </form>

</div>

@endsection