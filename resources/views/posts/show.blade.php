<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Szczegóły posta
        </h2>
    </x-slot>

    <div class="py-6 bg-white dark:bg-gray-800 rounded shadow p-6">
        <h3 class="text-2xl font-bold mb-2">{{ $post->title }}</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Dodano: {{ $post->created_at->format('d.m.Y H:i') }}</p>
        <div class="prose dark:prose-invert">
            {!! nl2br(e($post->body)) !!}
        </div>

        <div class="mt-6">
            <a href="{{ route('posts.index') }}" class="text-blue-500">← Powrót do listy</a>
        </div>
    </div>
</x-app-layout>
