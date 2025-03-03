<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight flex items-center gap-2">
            <!-- Iconcina a fianco al titolo (facoltativa) -->
            🏢
            <span>{{ __('Dettagli Azienda') }}</span>
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto mt-8 px-4 sm:mt-12">
        <!-- Messaggio di stato -->
        @if (session('status'))
            <div x-data="{ show: true }" x-show="show" style="background-color: #10B981;" {{-- #10B981 corrisponde a green-500 --}}
                class="mb-4 w-full max-w-4xl mx-auto p-4 text-white font-semibold
                    shadow-md rounded-lg flex justify-between items-center
                    transition-colors duration-300">
                <span>
                    {{ session('status') }}
                </span>
                <button @click="show = false" class="ml-4 text-white hover:text-gray-200 text-xl leading-none">
                    &times;
                </button>
            </div>
        @endif


        <!-- CARD con gradiente -->
        <div
            class="relative bg-gradient-to-br from-gray-800 via-gray-900 to-black shadow-2xl rounded-xl overflow-hidden">
            <!-- Decorazione in alto (ad es. un'ellisse semi-trasparente) -->
            <div
                class="absolute inset-0 opacity-10 bg-[radial-gradient(circle_at_top_left,_var(--tw-gradient-stops))] from-cyan-400 via-blue-500 to-purple-600">
            </div>

            <!-- Contenuto Card -->
            <div class="relative flex flex-col sm:flex-row items-center sm:items-start gap-8 p-8 text-white">

                <!-- Logo Azienda -->
                <div class="flex-shrink-0">
                    @if ($company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo di {{ $company->name }}"
                            class="w-48 h-48 object-cover rounded-full shadow-md ring-4 ring-gray-700">
                    @else
                        <div
                            class="w-48 h-48 rounded-full bg-gray-700 flex items-center justify-center shadow-md ring-4 ring-gray-700">
                            <span class="text-gray-300 text-sm">Nessun Logo</span>
                        </div>
                    @endif
                </div>

                <!-- Dati Azienda -->
                <div class="flex-1">
                    <!-- Titolo -->
                    <h3 class="text-4xl font-bold mb-2">{{ $company->name }}</h3>

                    <!-- Email -->
                    <p class="mb-2 text-gray-300">
                        <span class="font-semibold">Email:</span>
                        {{ $company->email ?? 'N/A' }}
                    </p>

                    <!-- Sito Web -->
                    <p class="mb-4 text-gray-300">
                        <span class="font-semibold">Sito Web:</span>
                        @if ($company->website)
                            <a href="{{ $company->website }}" target="_blank"
                                class="text-blue-400 hover:text-blue-300 underline break-all ml-1">
                                {{ $company->website }}
                            </a>
                        @else
                            <span class="text-gray-400 ml-1">N/A</span>
                        @endif
                    </p>

                    <!-- Pulsanti di Azione -->
                    <div class="mt-6 flex flex-wrap gap-3">
                        @if (auth()->user()->is_admin)
                            <!-- Modifica -->
                            <a href="{{ route('companies.edit', $company) }}"
                                class="inline-flex items-center px-5 py-2 rounded-md text-white bg-yellow-400 hover:bg-yellow-300 font-semibold transition">
                                ✏ Modifica
                            </a>
                            <!-- Elimina -->
                            <form action="{{ route('companies.destroy', $company) }}" method="POST"
                                onsubmit="return confirm('Sei sicuro di voler eliminare questa azienda?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-5 py-2 rounded-md text-white bg-red-600 hover:bg-red-500 font-semibold transition">
                                    ❌ Elimina
                                </button>
                            </form>
                        @endif

                        <!-- Torna all'elenco -->
                        <a href="{{ route('companies.index') }}"
                            class="inline-flex items-center px-5 py-2 rounded-md font-semibold transition-colors duration-300 text-white bg-gradient-to-r from-green-500 to-cyan-600 hover:from-green-400 hover:to-cyan-500">
                            ↩ Torna all'elenco
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
