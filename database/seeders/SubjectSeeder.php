<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['subject' => 'Mother Tongue',  'created_at' => now()],
            ['subject' => 'Filipino',  'created_at' => now()],
            ['subject' => 'English',  'created_at' => now()],
            ['subject' => 'Science',  'created_at' => now()],
            ['subject' => 'Mathematics',  'created_at' => now()],
            ['subject' => 'Araling Panglipunan',  'created_at' => now()],
            ['subject' => 'EPP/TLE',  'created_at' => now()],
            ['subject' => 'MAPEH',  'created_at' => now()],
            ['subject' => 'Edukasyon sa Pagpapakatao',  'created_at' => now()],
            ['subject' => 'Christian Living Education',  'created_at' => now()],
        ];
        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}
