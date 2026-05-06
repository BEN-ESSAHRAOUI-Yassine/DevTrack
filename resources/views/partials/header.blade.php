<header class="bg-white border-b px-8 py-4 flex justify-between items-center">

    {{-- Left: Title --}}
    <div>
        {{-- <h2 class="text-lg font-semibold text-gray-800">
            @yield('page-title', 'Dashboard')
        </h2>
        <p class="text-xs text-gray-400">
            Manage your projects efficiently
        </p> --}}
        
        <div class="text-sm text-gray-500 hidden sm:block">
            {{ now()->format('D, d M Y') }}
        </div>
    </div>

    {{-- Right: Actions + User --}}
    <div class="flex items-center gap-4">

        {{-- Date --}}
        

        {{-- Quick Action (optional but useful) --}}
        {{-- <a href="{{ route('projects.create') }}"
           class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-sm hover:bg-blue-700 transition">
            + Project
        </a> --}}

        {{-- User Avatar --}}
        <div class="flex items-center gap-2">

            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
            </div>

        </div>

    </div>

</header>