<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('🏢 Aziende') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('status_delete'))
            <div x-data="{ show: true }" x-show="show"
                class="mb-4 p-4 bg-green-500 text-white rounded-lg flex justify-between items-center">
                <div>
                    {{ session('status_delete') }}
                </div>
                <button @click="show = false" class="ml-4 text-white hover:text-gray-200 text-xl leading-none">
                    &times;
                </button>
            </div>
        @endif

        @if (session('success'))
            <div x-data="{ show: true }" x-show="show"
                class="mb-4 p-4 bg-green-500 text-white rounded-lg flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button @click="show = false" class="ml-4 text-white hover:text-gray-200 text-xl leading-none">
                    &times;
                </button>
            </div>
        @endif

        <div class="bg-gray-800 shadow-md rounded-lg p-6">

            <div class="flex justify-between items-center mb-6">
                <h3 class="text-white text-lg font-semibold">Lista Aziende</h3>

                @if (auth()->user()->is_admin)
                    <a href="{{ route('companies.create') }}"
                        class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center transition">
                        ➕ <span class="ml-2">Nuova Azienda</span>
                    </a>
                @endif
            </div>

            <div class="overflow-hidden rounded-lg shadow-lg">
                <table class="w-full text-white bg-gray-900 rounded-lg">
                    <thead class="bg-gray-700 text-gray-300 uppercase text-sm">
                        <tr>
                            <th class="py-4 px-6 text-left">Logo</th>
                            <th class="py-4 px-6 text-left">Nome</th>
                            <th class="py-4 px-6 text-left">Email</th>
                            <th class="py-4 px-6 text-left">Sito Web</th>
                            <th class="py-4 px-6 text-center">Azioni</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-300 text-sm">
                        @foreach ($companies as $company)
                            <tr class="border-b border-gray-700 hover:bg-gray-800 transition">
                                <td class="py-4 px-6">
                                    <img src="{{ asset('storage/' . $company->logo) }}"
                                        alt="Logo di {{ $company->name }}"
                                        class="w-14 h-14 rounded-full shadow-md border border-gray-600 object-cover">
                                </td>

                                <td class="py-4 px-6 font-semibold">{{ $company->name }}</td>

                                <td class="py-4 px-6 text-gray-400">{{ $company->email }}</td>

                                <td class="py-4 px-6">
                                    <a href="{{ $company->website }}" target="_blank"
                                        class="text-blue-400 hover:text-blue-300 flex items-center space-x-2">
                                        🌐 <span>Visita Sito</span>
                                    </a>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center space-x-3">
                                        <a href="{{ route('companies.show', $company) }}"
                                            class="text-green-400 hover:text-green-300 flex items-center transition">
                                            🔍 <span class="ml-1 hidden sm:inline">Dettagli</span>
                                        </a>

                                        @if (auth()->user()->is_admin)
                                            <a href="{{ route('companies.edit', $company) }}"
                                                class="text-yellow-400 hover:text-yellow-300 flex items-center transition">
                                                ✏ <span class="ml-1 hidden sm:inline">Modifica</span>
                                            </a>

                                            <form action="{{ route('companies.destroy', $company) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-400 hover:text-red-300 flex items-center transition"
                                                    onclick="return confirm('Sei sicuro di voler eliminare questa azienda?')">
                                                    ❌ <span class="ml-1 hidden sm:inline">Elimina</span>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6 flex justify-center">
                {{ $companies->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
