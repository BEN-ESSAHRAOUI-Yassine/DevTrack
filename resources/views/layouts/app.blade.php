<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DevTrack</title>
    @vite(['resources/css/app.css'])
</head>

<body class="bg-gray-50">

<div class="flex h-screen">

    @include('partials.sidebar')

    <div class="flex flex-col flex-1">

        @include('partials.header')

        <main class="flex-1 overflow-y-auto p-8">
            @yield('content')
        </main>

        @include('partials.footer')

    </div>

</div>

</body>
</html>