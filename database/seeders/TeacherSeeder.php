<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teachers = [
            ['name' => 'Teacher 1', 'gender' => 'Female', 'age' => '26', 'contact' => '09123456789', 'email' => 'bcateacher1@app.com', 'created_at' => now()],
            ['name' => 'Teacher 2', 'gender' => 'Female', 'age' => '26', 'contact' => '09123456789', 'email' => 'bcateacher2@app.com', 'created_at' => now()],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
