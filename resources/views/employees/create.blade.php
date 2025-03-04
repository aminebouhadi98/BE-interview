<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Nuovo Dipendente') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Crea Nuovo Dipendente</h1>

            <form action="{{ route('employees.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="first_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Nome
                    </label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                          focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                    @error('first_name')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Cognome
                    </label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                          focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                          dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        required>
                    @error('last_name')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('email')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Telefono
                    </label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    @error('phone')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>



                <div>
                    <label for="company_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Azienda
                    </label>
                    <select name="company_id" id="company_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                   focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                   dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="">-- Seleziona Azienda --</option>
                        @foreach ($companies as $company)
                            <option value="{{ $company->id }}"
                                {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                {{ $company->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('company_id')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-3 mt-6">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500 font-semibold transition">
                        Crea Dipendente
                    </button>
                    <a href="{{ route('employees.index') }}"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded font-semibold transition">
                        Annulla
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
