<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $tags       = Tag::all();

        $posts = [
            [
                'title' => 'Getting Started with Laravel',
                'body'  => 'Laravel is a web application framework with expressive, elegant syntax.',
                'color' => 'blue',
            ],
            [
                'title' => 'Understanding PHP 8 Features',
                'body'  => 'PHP 8 introduced many new features including named arguments, match expressions, and more.',
                'color' => 'purple',
            ],
            [
                'title' => 'Building REST APIs',
                'body'  => 'REST APIs are a popular way to build web services that can be consumed by any client.',
                'color' => 'green',
            ],
            [
                'title' => 'Database Optimization Tips',
                'body'  => 'Optimizing your database queries can significantly improve application performance.',
                'color' => 'orange',
            ],
            [
                'title' => 'Introduction to Vue.js',
                'body'  => 'Vue.js is a progressive JavaScript framework for building user interfaces.',
                'color' => 'teal',
            ],
        ];

        foreach ($posts as $data) {
            $post = Post::create([
                'title'        => $data['title'],
                'slug'         => Str::slug($data['title']),
                'category_id'  => $categories->random()->id,
                'color'        => $data['color'],
                'body'         => $data['body'],
                'published'    => true,
                'published_at' => now()->subDays(rand(1, 30)),
            ]);

            // Attach 2–3 random tags to each post
            $post->tags()->attach(
                $tags->random(rand(2, 3))->pluck('id')->toArray()
            );
        }
    }
}
