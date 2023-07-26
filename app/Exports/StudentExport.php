<?php

namespace App\Exports;

use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class StudentExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Students';
    }
    public function collection()
    {
        return Student::select(
            'id',
            'student_id',
            'student_lrn',
            'first_name',
            'middle_name',
            'last_name',
            'ext_name',
            'gender',
            'age',
            'email',
            'birth_date',
            'birthplace',
            'address',
            'section_id',
            'sy_id',
            'grade_level_id',
            'student_type',
            'department',
            'status',
            'enrollmentCompleted',
            'hasVerifiedEmail',
            'hasPromissoryNote',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($student): array
    {
        return [
            $student->id,
            $student->student_id,
            $student->student_lrn,
            $student->first_name,
            $student->middle_name,
            $student->last_name,
            $student->ext_name,
            $student->gender,
            $student->age,
            $student->email,
            $student->birth_date,
            $student->birthplace,
            $student->address,
            $student->section_id,
            $student->sy_id,
            $student->grade_level_id,
            $student->student_type,
            $student->department,
            $student->status,
            $student->enrollmentCompleted,
            $student->hasVerifiedEmail,
            $student->hasPromissoryNote,
            $student->created_at,
            $student->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Student ID',
            'LRN',
            'First Name',
            'Middle Name',
            'Last Name',
            'Ext Name',
            'Gender',
            'Age',
            'Email',
            'Birth Date',
            'Birthplace',
            'Address',
            'Section ID',
            'SY ID',
            'Grade Level ID',
            'Student Type',
            'Department',
            'Status',
            'Enrollment Completed',
            'Has Verified Email',
            'Has Promissory Note',
            'Created At',
            'Updated At',
        ];
    }
}
