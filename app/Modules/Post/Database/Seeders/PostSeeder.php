<?php

namespace App\Modules\Post\Database\Seeders;

use Illuminate\Database\Seeder;
use App\Modules\Post\Models\Post;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::create(['name' => 'Sample Post']);

        // Uncomment to use factory if available
        // Post::factory()->count(10)->create();
    }
}
