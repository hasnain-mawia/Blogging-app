<?php

namespace Database\Seeders;

use App\Models\categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['Science', 'Sports', 'Entertainment'];

        foreach($categories as $category){
        categories::create([
            'name' => $category
        ]);
    }
    }
}
