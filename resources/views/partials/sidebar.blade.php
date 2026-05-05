@auth
    
<aside class="w-64 bg-white border-r px-6 py-6 flex flex-col">

    <h1 class="text-2xl font-bold mb-8">DevTrack</h1>

    <nav class="space-y-3 text-sm">

        <a href="{{ route('projects.index') }}"
           class="block text-gray-700 hover:text-blue-600">
            Projects
        </a>

        <a href="{{ route('projects.archives') }}"
           class="block text-gray-500 hover:text-blue-600">
            Archived Projects
        </a>

    </nav>

    <div class="mt-auto pt-6 border-t text-sm">

        <p class="text-gray-600">{{ auth()->user()->name ?? '' }}</p>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-red-500 mt-2">Logout</button>
        </form>

    </div>

</aside>
@endauth