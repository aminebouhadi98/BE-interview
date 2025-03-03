<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Dettagli Dipendente') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">
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
        <div class="bg-gray-800 shadow-md rounded-lg p-6 text-white">
            <h1 class="text-2xl font-semibold mb-4">Dettagli Dipendente</h1>

            <div class="mb-4">
                <p><strong>Nome:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
                <p><strong>Email:</strong> {{ $employee->email ?? 'N/A' }}</p>
                <p><strong>Telefono:</strong> {{ $employee->phone ?? 'N/A' }}</p>
                @if (isset($employee->company))
                    <p><strong>Azienda:</strong> {{ $employee->company->name }}</p>
                @endif
            </div>

            <div class="flex gap-3">
                @if (auth()->user()->is_admin)
                    <a href="{{ route('employees.edit', $employee->id) }}"
                        class="px-4 py-2 bg-yellow-400 hover:bg-yellow-300 text-black rounded-md font-semibold transition">
                        ✏ Modifica
                    </a>
                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                        onsubmit="return confirm('Sei sicuro di voler eliminare questo dipendente?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white rounded-md font-semibold transition">
                            ❌ Elimina
                        </button>
                    </form>
                @endif

                <a href="{{ route('employees.index') }}"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded-md font-semibold transition">
                    ↩ Torna all'elenco
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
