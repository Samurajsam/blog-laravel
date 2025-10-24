<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Lista postów
            </h2>
            @auth
                <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Dodaj nowy post
                </a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @forelse ($posts as $post)
                        <div class="border-b border-gray-300 dark:border-gray-700 py-4 last:border-b-0">
                            <h3 class="text-xl font-semibold mb-2">
                                <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-500">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                Autor: <strong>{{ $post->user->name }}</strong> | 
                                {{ $post->created_at->format('d.m.Y H:i') }} |
                                Komentarze: {{ $post->comments_count ?? 0 }}
                            </p>
                            <p class="text-gray-700 dark:text-gray-300 mt-2">{{ Str::limit($post->body, 200) }}</p>
                            <div class="mt-3 flex gap-3">
                                <a href="{{ route('posts.show', $post) }}" class="text-blue-500 hover:text-blue-700">Czytaj więcej</a>
                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500 hover:text-yellow-700">Edytuj</a>
                                @endcan
                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline-block" onsubmit="return confirm('Czy na pewno chcesz usunąć ten post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Usuń</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400">Brak postów. 
                            @auth
                                <a href="{{ route('posts.create') }}" class="text-blue-500 hover:text-blue-700">Dodaj pierwszy post!</a>
                            @endauth
                        </p>
                    @endforelse

                    <div class="mt-6">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>