<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Backup implements WithMultipleSheets,ShouldAutoSize
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

        // Add Subjects sheet
        $sheets[] = new SubjectExport();

        // Add Grade Levels sheet
        $sheets[] = new GradeLevelExport();

        // Add Sections sheet
        $sheets[] = new SectionExport();
        
        // Add Teachers sheet
        $sheets[] = new TeacherExport();

        // Add Student Grade sheet
        $sheets[] = new StudentGradeExport();

         // Add Annuals
        $sheets[] = new AnnualExport();

         // Add Levels
        $sheets[] = new LevelExport();

        // Add Bank Accounts
        $sheets[] = new BankAccountExport();

        /* // Add Balances
        $sheets[] = new BalanceExport();

        // Add Payments
        $sheets[] = new PaymentExport();

        // Add Payment Logs
        $sheets[] = new PaymentLogExport(); */
        



        return $sheets;
    }
}
