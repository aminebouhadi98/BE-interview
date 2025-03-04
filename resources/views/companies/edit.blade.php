<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-white leading-tight">
            {{ __('Modifica Azienda') }}
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Modifica Azienda</h1>

            <form action="{{ route('companies.update', $company->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Nome
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $company->name) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    @error('name')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $company->email) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    @error('email')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="logo" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Logo (min. 100x100)
                    </label>
                    <input type="file" name="logo" id="logo"
                        class="mt-1 block w-full text-sm text-gray-900
                                  bg-gray-50 rounded-lg border border-gray-300 cursor-pointer
                                  focus:outline-none focus:border-indigo-300 focus:ring
                                  dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    @error('logo')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror

                    @if ($company->logo)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Logo attuale"
                                class="h-16 w-16 object-cover rounded border border-gray-400" />
                        </div>
                    @endif
                </div>

                <div>
                    <label for="website" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
                        Sito Web
                    </label>
                    <input type="url" name="website" id="website" value="{{ old('website', $company->website) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm
                                  focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
                                  dark:bg-gray-700 dark:border-gray-600 dark:text-white" />
                    @error('website')
                        <p class="text-red-600 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex space-x-3 mt-6">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500 font-semibold transition">
                        Aggiorna
                    </button>
                    <a href="{{ route('companies.show', $company->id) }}"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-500 text-white rounded font-semibold transition">
                        Annulla
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
