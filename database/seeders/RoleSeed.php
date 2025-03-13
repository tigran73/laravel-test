<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'desc' => 'Administrator',
            ],
            [
                'id' => 2,
                'name' => 'content-manager',
                'desc' => 'Content Manager',
            ],
            [
                'id' => 3,
                'name' => 'user',
                'desc' => 'User',
            ],
        ]);
    }
}
