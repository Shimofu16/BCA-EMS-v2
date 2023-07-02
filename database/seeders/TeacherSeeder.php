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
            [
                'name' => 'John Doe',
                'gender' => 'Male',
                'age' => 30,
                'contact' => '123456789',
                'email' => 'john.doe@example.com',
            ],
            [
                'name' => 'Jane Smith',
                'gender' => 'Female',
                'age' => 35,
                'contact' => '987654321',
                'email' => 'jane.smith@example.com',
            ],
            [
                'name' => 'Teacher 1',
                'gender' => 'Female',
                'age' => 35,
                'contact' => '987654321',
                'email' => 'bcateacher@app.com',
            ],
        ];

        foreach ($teachers as $teacher) {
            Teacher::create($teacher);
        }
    }
}
