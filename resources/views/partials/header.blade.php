<header class="bg-white border-b px-8 py-4 flex justify-between items-center">

    <h2 class="text-lg font-semibold">
        @yield('page-title', 'Dashboard')
    </h2>

    <div class="text-sm text-gray-500">
        {{ now()->format('d M Y') }}
    </div>

</header>