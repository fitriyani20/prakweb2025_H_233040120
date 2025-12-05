<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // 1. Membuat 5 User secara manual (Sesuai Tugas: 5 Users)
        // Kita gunakan loop agar username user1 s/d user5 rapi
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'User ' . $i,
                'username' => 'user' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => bcrypt('password'),
            ]);
        }

        // 5 Categories
        Category::factory(5)->create();


        // 10 Posts
        Post::factory(10)
            ->recycle(User::all())
            ->recycle(Category::all())
            ->create();
    
    }
}
