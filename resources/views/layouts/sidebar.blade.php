<aside class="bg-gray-800 w-64 text-white p-4">
    <div class="text-xl font-bold mb-6">
        {{ __('Menu') }}
    </div>
    <nav class="space-y-2">
        <a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-700">
            {{ __('Dashboard') }}
        </a>
        <a href="" class="block py-2 px-3 rounded hover:bg-gray-700">
            {{ __('Aziende') }}
        </a>
        <a href="" class="block py-2 px-3 rounded hover:bg-gray-700">
            {{ __('Dipendenti') }}
        </a>
        <!-- Altri link se vuoi -->
    </nav>
</aside>
