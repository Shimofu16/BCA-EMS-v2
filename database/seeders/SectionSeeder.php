<?php

namespace Database\Seeders;

use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            ['name' => 'Loyal', 'grade_level_id' => 1, 'teacher_id' => Teacher::find(1)->id, 'created_at' => now()],
            ['name' => 'Happiness', 'grade_level_id' => 2, 'created_at' => now()],
            ['name' => 'Hope', 'grade_level_id' => 3, 'created_at' => now()],
            ['name' => 'Faith', 'grade_level_id' => 4, 'created_at' => now()],
            ['name' => 'Love', 'grade_level_id' => 5, 'created_at' => now()],
            ['name' => 'Trustworthy', 'grade_level_id' => 6, 'created_at' => now()],
            ['name' => 'Honesty', 'grade_level_id' => 7, 'created_at' => now()],
            ['name' => 'Courage', 'grade_level_id' => 8, 'created_at' => now()],
            ['name' => 'Humility', 'grade_level_id' => 9, 'created_at' => now()],
            ['name' => 'Charity', 'grade_level_id' => 10, 'created_at' => now()],
            ['name' => 'Patience', 'grade_level_id' => 11, 'created_at' => now()],
            ['name' => 'Obedience', 'grade_level_id' => 12, 'created_at' => now()],
            ['name' => 'Integrity', 'grade_level_id' => 13, 'created_at' => now()],
            ['name' => 'Wisdom', 'grade_level_id' => 14, 'created_at' => now()],
        ];
        foreach ($sections as $section) {
            Section::create($section);
        }
    }
}
