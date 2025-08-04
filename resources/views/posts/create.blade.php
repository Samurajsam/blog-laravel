<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Dodaj nowy post
        </h2>
    </x-slot>

    <div class="py-6">
        <form action="{{ route('posts.store') }}" method="POST" class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            @csrf

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tytuł</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white">
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="body" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Treść</label>
                <textarea name="body" id="body" rows="5" class="w-full mt-1 rounded border-gray-300 dark:bg-gray-700 dark:text-white">{{ old('body') }}</textarea>
                @error('body')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Zapisz</button>
        </form>
    </div>
</x-app-layout>

