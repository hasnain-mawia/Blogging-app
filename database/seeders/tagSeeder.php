<?php

namespace Database\Seeders;

use App\Models\tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class tagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
        $tags = ['php', 'Laravel php', 'Backend Development', 'frontend Developement'];

        foreach($tags as $tag){
        tags::create([
            'name' => $tag
        ]);
    }
    }
}
