<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Laravel',
            'PHP',
            'JavaScript',
            'Vue',
            'React',
            'API',
            'Database',
            'DevOps',
            'Tutorial',
            'Tips',
        ];

        foreach ($tags as $name) {
            Tag::create(['name' => $name]);
        }
    }
}
