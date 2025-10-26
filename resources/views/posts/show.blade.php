<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Szczegóły posta
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Post Content -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-2">{{ $post->title }}</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                        Autor: {{ $post->user->name }} | Dodano: {{ $post->created_at->format('d.m.Y H:i') }}
                    </p>
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($post->body)) !!}
                    </div>

                    <div class="mt-6 flex gap-4">
                        <a href="{{ route('posts.index') }}" class="text-blue-500 hover:text-blue-700">← Powrót do listy</a>
                        @can('update', $post)
                            <a href="{{ route('posts.edit', $post) }}" class="text-yellow-500 hover:text-yellow-700">Edytuj</a>
                        @endcan
                        @can('delete', $post)
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700" onclick="return confirm('Czy na pewno chcesz usunąć ten post?')">Usuń</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h4 class="text-xl font-bold mb-4">Komentarze ({{ $post->comments->count() }})</h4>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Add Comment Form -->
                    @auth
                        <form action="{{ route('comments.store') }}" method="POST" class="mb-6">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <div class="mb-4">
                                <label for="content" class="block text-sm font-medium mb-2">Dodaj komentarz</label>
                                <textarea 
                                    name="content" 
                                    id="content" 
                                    rows="3" 
                                    class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                    placeholder="Twój komentarz..."
                                    required
                                >{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <x-primary-button>Dodaj komentarz</x-primary-button>
                        </form>
                    @else
                        <div class="mb-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4">
                            <p class="text-blue-800 dark:text-blue-200">
                                <svg class="inline w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <strong>Komentarze tylko dla zalogowanych użytkowników.</strong>
                            </p>
                            <p class="text-blue-700 dark:text-blue-300 mt-2">
                                <a href="{{ route('login') }}" class="font-semibold hover:underline">Zaloguj się</a> lub 
                                <a href="{{ route('register') }}" class="font-semibold hover:underline">zarejestruj</a>, aby dodać komentarz.
                            </p>
                        </div>
                    @endauth

                    <!-- Comments List -->
                    @forelse($post->comments as $comment)
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                        <strong>{{ $comment->user->name }}</strong> - {{ $comment->created_at->format('d.m.Y H:i') }}
                                    </p>
                                    <p class="text-gray-900 dark:text-gray-100">{{ $comment->content }}</p>
                                </div>
                                @can('delete', $comment)
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm" onclick="return confirm('Czy na pewno chcesz usunąć ten komentarz?')">
                                            Usuń
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-600 dark:text-gray-400 mt-4">Brak komentarzy. Bądź pierwszy!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
