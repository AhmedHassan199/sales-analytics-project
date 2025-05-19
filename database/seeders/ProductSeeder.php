<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder {
    public function run() {
        DB::table('products')->insert([
            ['name' => 'Product A', 'price' => 100.00, 'description' => 'Description of Product A', 'category_id' => 1], // Hot Drinks
            ['name' => 'Product B', 'price' => 200.00, 'description' => 'Description of Product B', 'category_id' => 2], // Cold Drinks
            ['name' => 'Product C', 'price' => 300.00, 'description' => 'Description of Product C', 'category_id' => 1], // Hot Drinks
            ['name' => 'Product D', 'price' => 400.00, 'description' => 'Description of Product D', 'category_id' => 2], // Cold Drinks
        ]);
    }
}
