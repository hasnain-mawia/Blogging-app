<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
            'name' => 'Hasnain mawia',
            'email' => 'hasnain@gmail.com',
            'password' => Hash::make(123456789),
            'is_admin' => 1,
           ]);
        User::create(
            [
            'name' => 'ABC',
            'email' => 'abc@gmail.com',
            'password' => Hash::make(123456789),
            'is_admin' => 1,
           ]);
    }
}
