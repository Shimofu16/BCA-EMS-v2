<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpsertColumns;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentsImport implements ToCollection, WithHeadingRow
{
    use Importable;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            if ($row['status'] === null) {
                $row['status'] = 0;
            }
            if ($row['is_done_enrolling'] === null) {
                $row['is_done_enrolling'] = 0;
            }
            if ($row['has_verified_email'] === null) {
                $row['has_verified_email'] = 0;
            }
            if ($row['has_promissory_note'] === null) {
                $row['has_promissory_note'] = 0;
            }
            $student = Student::where('student_id', $row['student_id'])
                ->orWhere('email', $row['email'])
                ->first();
            if ($student) {
                $student->student_id = $row['student_id'];
                $student->student_lrn = $row['student_lrn'];
                $student->first_name = $row['first_name'];
                $student->middle_name = $row['middle_name'];
                $student->last_name = $row['last_name'];
                $student->ext_name = $row['ext_name'];
                $student->gender = $row['gender'];
                $student->age = $row['age'];
                $student->email = $row['email'];
                $student->birth_date = $row['birth_date'];
                $student->birthplace = $row['birthplace'];
                $student->address = $row['address'];
                $student->section_id = $row['section_id'];
                $student->grade_level_id = $row['grade_level_id'];
                $student->sy_id = $row['school_year_id'];
                $student->student_type = $row['student_type'];
                $student->department = $row['department'];
                $student->status = $row['status'];
                $student->isDone = $row['is_done_enrolling'];
                $student->hasVerifiedEmail = $row['has_verified_email'];
                $student->hasPromissoryNote = $row['has_promissory_note'];
                $student->updated_by = 'System';
                $student->updated_at = now();
                $student->save();
            } else {
                Student::create([
                    'student_id' => $row['student_id'],
                    'student_lrn' => $row['student_lrn'],
                    'first_name' => $row['first_name'],
                    'middle_name' => $row['middle_name'],
                    'last_name' => $row['last_name'],
                    'ext_name' => $row['ext_name'],
                    'gender' => $row['gender'],
                    'age' => $row['age'],
                    'email' => $row['email'],
                    'birth_date' => $row['birth_date'],
                    'birthplace' => $row['birthplace'],
                    'address' => $row['address'],
                    'section_id' => $row['section_id'],
                    'grade_level_id' => $row['grade_level_id'],
                    'sy_id' => $row['school_year_id'],
                    'student_type' => $row['student_type'],
                    'department' => $row['department'],
                    'status' => $row['status'],
                    'isDone' => $row['is_done_enrolling'],
                    'hasVerifiedEmail' => $row['has_verified_email'],
                    'hasPromissoryNote' => $row['has_promissory_note'],
                    'created_by' => 'Imported to system',
                    'created_at' => now(),
                ]);
            }
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
