<?php

namespace Database\Seeders;

use App\Models\GradeLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gradeLevels = [
            ['display_name' => 'Play Group', 'name' => 'Play Group', 'created_at' => now()],
            ['display_name' => 'Nursery', 'name' => 'Nursery', 'created_at' => now()],
            ['display_name' => 'Kindergarten', 'name' => 'Kindergarten', 'created_at' => now()],
            ['display_name' => 'Preparatory', 'name' => 'Preparatory', 'created_at' => now()],
            ['display_name' => 'Grade - 1', 'name' => '1', 'created_at' => now()],
            ['display_name' => 'Grade - 2', 'name' => '2', 'created_at' => now()],
            ['display_name' => 'Grade - 3', 'name' => '3', 'created_at' => now()],
            ['display_name' => 'Grade - 4', 'name' => '4', 'created_at' => now()],
            ['display_name' => 'Grade - 5', 'name' => '5', 'created_at' => now()],
            ['display_name' => 'Grade - 6', 'name' => '6', 'created_at' => now()],
            ['display_name' => 'Grade - 7', 'name' => '7', 'created_at' => now()],
            ['display_name' => 'Grade - 8', 'name' => '8', 'created_at' => now()],
            ['display_name' => 'Grade - 9', 'name' => '9', 'created_at' => now()],
            ['display_name' => 'Grade - 10', 'name' => '10', 'created_at' => now()],
        ];

        foreach ($gradeLevels as $gradeLevel) {
            GradeLevel::create($gradeLevel);
        }
    }
}
