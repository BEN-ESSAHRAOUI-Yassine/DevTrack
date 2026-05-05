@extends('layouts.app')

@section('content')

<div class="max-w-md mx-auto bg-white p-6 rounded-xl border">

<h1 class="text-xl font-bold mb-4">Login</h1>

<form method="POST" action="{{ route('login') }}">
@csrf

<input name="email" class="w-full border p-2 mb-3 rounded">
<input type="password" name="password" class="w-full border p-2 mb-3 rounded">

<button class="w-full bg-blue-600 text-white py-2 rounded">
Login
</button>

</form>

</div>

@endsection