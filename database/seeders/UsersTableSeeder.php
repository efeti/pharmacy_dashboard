<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('password');

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            // 'email_verified_at' => now(),
            'password' => $password,
        ]);
    }
}
