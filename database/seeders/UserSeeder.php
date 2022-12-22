<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'name' => 'Admin',
            'role' => 1,
            'email' => 'admin1111@gmail.com',
            'password' => Hash::make('admin1111'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
