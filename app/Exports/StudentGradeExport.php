<?php

namespace App\Exports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
class StudentGradeExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Student Grades';
    }
    public function collection()
    {
        return Grade::select(
            'id',
            'class_id',
            'student_id',
            'first_grading',
            'second_grading',
            'third_grading',
            'fourth_grading',
            'final_grade',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($studentGrade): array
    {
        return [
            $studentGrade->id,
            $studentGrade->class_id,
            $studentGrade->student_id,
            $studentGrade->first_grading,
            $studentGrade->second_grading,
            $studentGrade->third_grading,
            $studentGrade->fourth_grading,
            $studentGrade->final_grade,
            $studentGrade->created_at,
            $studentGrade->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Class ID',
            'Student ID',
            'First Grading',
            'Second Grading',
            'Third Grading',
            'Fourth Grading',
            'Final Grade',
            'Created At',
            'Updated At',
        ];
    }
}
