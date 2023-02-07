<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Storage::deleteDirectory('public');
        Storage::deleteDirectory('user');
        Storage::deleteDirectory('thumbnail');
        Storage::deleteDirectory('profile-image');
        \App\Models\User::factory(20)->create();

        \App\Models\Post::factory(20)->create();
        \App\Models\Comment::factory(1000)->create();
        \App\Models\Category::factory(8)->create();

        foreach (Category::all() as $category) {
            $posts = Post::inRandomOrder()->take(rand(4, 8))->pluck('id');
            $category->posts()->attach($posts);
        }
        foreach (Post::all() as $post) {

            $post->addMediaFromUrl(fake()->imageUrl(1280, 720))
                ->withResponsiveImages()
                ->toMediaCollection('thumbnails', 'thumbnail');
        }
        foreach (User::all() as $user) {
            $user->addMediaFromUrl(fake()->imageUrl())

                ->toMediaCollection('profileImages', 'profile-image');
        }
    }
}