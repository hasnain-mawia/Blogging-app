<?php

namespace Database\Seeders;

use App\Models\tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $tags = ['Php', 'Laravel', 'Codeigniter', 'Fullstack Developer', 'Backend Developer'];

        foreach($tags as $tag){
            tags::create([
            'name' =>  $tag
        ]);
    }
    }
}
