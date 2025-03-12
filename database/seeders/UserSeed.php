<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'id' => 2,
                'name' => 'manager',
                'email' => 'manager@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'id' => 3,
                'name' => 'user',
                'email' => 'user@mail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        ]);
    }
}
