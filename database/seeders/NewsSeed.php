<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $news = [];

        for ($i=0;$i<=12;$i++){
            $news[] = [
                'name' => fake()->realText(50),
                'description' => fake()->realText(),
                'image' => 'img.png',
                'author' => rand(1,2),
                'views' => rand(10,100),
                'created_at' => now(),
                'updated_at' => Carbon::now()->addDays($i),
            ];
        }
        DB::table('news')->insert($news);
    }
}
