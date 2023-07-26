<?php

namespace App\Exports;

use App\Models\Enrollment;
use App\Models\EnrollmentLog;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class EnrollmentExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Enrollments Log';
    }
    public function collection()
    {
        return EnrollmentLog::select('id', 'student_id', 'grade_level_id', 'sy_id', 'department', 'student_type', 'created_at', 'updated_at')->get();
    }

    public function map($enrollment): array
    {
        return [
            $enrollment->id,
            $enrollment->student_id,
            $enrollment->grade_level_id,
            $enrollment->sy_id,
            $enrollment->department,
            $enrollment->student_type,
            $enrollment->created_at,
            $enrollment->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Student ID',
            'Grade Level ID',
            'School Year ID',
            'Department',
            'Student Type',
            'Created At',
            'Updated At',
        ];
    }
}
