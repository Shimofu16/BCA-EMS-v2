<?php

namespace Database\Seeders;

use App\Models\FamilyMember;
use App\Models\SchoolYear;
use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $students = [
        //     [
        //         'student_id' => '2021-00001-BCA-0',
        //         'last_name' => 'Tamad',
        //         'first_name' => 'Juan',
        //         'middle_name' => 'Dy',
        //         'gender' => 'Male',
        //         'age' => 3,
        //         'email' => 'juantamad@gmail.com',
        //         'birth_date' => '2017-04-23',
        //         'birthplace' => 'calauan,laguna',
        //         'address' => 'calauan,laguna',
        //         'student_type' => 'Old Student',
        //         'department' => 'Preschool',
        //         'hasVerifiedEmail' => 1,
        //         'enrollmentCompleted' => 0,
        //         'grade_level_id' => 1,
        //         'status' => 'enrollee', //enrolled, not enrolled, pending, graduated, dropped
        //         'sy_id' => SchoolYear::find(2)->id,
        //         'created_at' => now(),
        //     ],
        // ];
        // foreach ($students as $student) {
        //     Student::create($student);
        // }
        // $families = [
        //     [
        //         'student_id' => 1,
        //         'name' => 'Dino Sy Tamad',
        //         'birth_date' => '2000-05-23',
        //         'contact_no' => '09123456782',
        //         'email' => 'dinosyt@gmail.com',
        //         'relationship' => 'Father',
        //         'relationship_type' => 'father',
        //         'occupation' => 'Teacher',
        //         'office_contact_no' => '09123456785',
        //     ],
        //     [
        //         'student_id' => 1,
        //         'name' => 'Gina Dy Tamad',
        //         'birth_date' => '2000-05-23',
        //         'contact_no' => '09123456789',
        //         'email' => 'ginadyt@gmail.com',
        //         'relationship' => 'Mother',
        //         'relationship_type' => 'mother',
        //         'occupation' => 'Teacher',
        //         'office_contact_no' => '09123456785',
        //     ],
        //     [
        //         'student_id' => 1,
        //         'name' => 'Gina Dy Tamad 2',
        //         'relationship_type' => 'guardian',
        //         'relationship' => 'Guardian',
        //         'contact_no' => '09123456789',
        //         'email' => 'ginadyt@gmail.com',
        //         'address' => 'Brgy. Pook 1, Calauan Laguna',
        //     ],
        // ];

        // foreach ($families as $family) {
        //     FamilyMember::create($family);
        // }
    }
}
