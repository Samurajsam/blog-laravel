<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first(); // zakładamy, że istnieje przynajmniej jeden użytkownik

        if (!$user) {
            $user = User::factory()->create(); // tworzymy użytkownika, jeśli nie ma
        }

        Post::factory()->count(10)->create([
            'user_id' => $user->id,
        ]);
    }
}