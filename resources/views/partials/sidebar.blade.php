@auth

<aside class="w-64 bg-white border-r px-6 py-6 flex flex-col">

    {{-- Logo / Title --}}
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">DevTrack</h1>
        <p class="text-xs text-gray-400">Project Management</p>
    </div>

    {{-- Navigation --}}
    <nav class="space-y-2 text-sm">

        {{-- Active Projects --}}
        <a href="{{ route('projects.index') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition
           {{ request()->routeIs('projects.index')
                ? 'bg-blue-50 text-blue-600 font-medium'
                : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">

            📁 <span>Active Projects</span>
        </a>

        {{-- Archived --}}
        <a href="{{ route('projects.archived') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition
           {{ request()->routeIs('projects.archived')
                ? 'bg-blue-50 text-blue-600 font-medium'
                : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">

            🗂 <span>Archived Projects</span>
        </a>

        {{-- My Projects --}}
        <a href="{{ route('projects.mine') }}"
           class="flex items-center gap-2 px-3 py-2 rounded-lg transition
           {{ request()->routeIs('projects.mine')
                ? 'bg-blue-50 text-blue-600 font-medium'
                : 'text-gray-600 hover:bg-gray-100 hover:text-blue-600' }}">

            👤 <span>My Projects</span>
        </a>

    </nav>

    {{-- Footer / User --}}
    <div class="mt-auto pt-6 border-t">

        <div class="flex items-center gap-3 mb-3">
            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div>
                <p class="text-sm font-medium text-gray-700">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-gray-400">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full text-left text-red-500 text-sm hover:underline">
                Logout
            </button>
        </form>

    </div>

</aside>

@endauth