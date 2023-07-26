<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Pre - School 1 (Play Group & Nursery)',
                'display_name' => 'Pre - School 1',
            ],
            [
                'name' => 'Pre - School 2 (Kindergarten)',
                'display_name' => 'Pre - School 2',
            ],
            [
                'name' => 'Pre - School 3 (Preparatory)',
                'display_name' => 'Pre - School 3',
            ],
            [
                'name' => 'Elementary 1 (Grade 1 - 3)',
                'display_name' => 'Elementary 1',
            ],
            [
                'name' => 'Elementary 2 (Grade 4 - 6)',
                'display_name' => 'Elementary 2',
            ],
            [
                'name' => 'Junior Highschool (Grade 7 - 10)',
                'display_name' => 'Junior Highschool',
            ]
        ];
        foreach ($levels as $key => $level) {
            Level::create($level);
        }
    }
}
