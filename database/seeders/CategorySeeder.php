<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            ['name' => 'Hot Drinks', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cold Drinks', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

