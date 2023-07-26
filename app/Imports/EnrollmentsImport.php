<?php

namespace App\Imports;

use App\Models\EnrollmentLog;
use App\Models\Student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class EnrollmentsImport implements ToCollection, WithHeadingRow
{
    use Importable;
    /**
     * @param Collection $collection
     */
    public function collection(Collection $enrollments)
    {
        foreach ($enrollments as $enrollment) {
            $student = Student::with('enrollmentLogs')->where('student_id', $enrollment['student_id'])->first();
            if ($student) {
                $log = EnrollmentLog::where('student_id', $student->id)->first();
                if ($log) {
                    $log->update([
                        'grade_level_id' => $enrollment['grade_level_id'],
                        'sy_id' => $enrollment['school_year_id'],
                        'department' => $enrollment['department'],
                        'student_type' => $enrollment['student_type'],
                        'updated_at' => $enrollment['updated_at'],
                    ]);
                } else {
                    EnrollmentLog::create([
                        'student_id' => $student->id,
                        'grade_level_id' => $enrollment['grade_level_id'],
                        'sy_id' => $enrollment['school_year_id'],
                        'department' => $enrollment['department'],
                        'student_type' => $enrollment['student_type'],
                        'created_at' => $enrollment['created_at'],
                    ]);
                }
            }
        }
    }
    public function headingRow(): int
    {
        return 1;
    }
}
