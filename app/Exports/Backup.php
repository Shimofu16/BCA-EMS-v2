<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Backup implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        // Add Student sheet
        $sheets[] = new StudentExport();

        // Add Enrollment Log sheet
        $sheets[] = new EnrollmentExport();

        // Add Users sheet
        $sheets[] = new UserExport();
        // Add User Logs sheet
        $sheets[] = new UserLogExport();

        return $sheets;
    }
}
