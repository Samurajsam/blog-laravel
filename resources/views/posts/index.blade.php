<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Lista postów
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Dodaj nowy post</a>

        <div class="mt-6 bg-white dark:bg-gray-800 shadow rounded p-6">
            @forelse ($posts as $post)
                <div class="border-b border-gray-300 dark:border-gray-700 py-4">
                    <h3 class="text-lg font-semibold">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $post->created_at->format('d.m.Y H:i') }}</p>
                    <p class="mt-2">{{ Str::limit($post->body, 150) }}</p>
                    <div class="mt-2">
                        <a href="{{ route('posts.show', $post) }}" class="text-blue-500">Pokaż</a> |
                        <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500">Edytuj</a> |
                        <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Na pewno usunąć?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">Usuń</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Brak postów.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>