<?php

namespace App\Exports;

use App\Models\GradeLevel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class GradeLevelExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Grade Levels';
    }
    public function collection()
    {
        return GradeLevel::select(
            'id',
            'name',
            'display_name',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($gradeLevel): array
    {
        return [
            $gradeLevel->id,
            $gradeLevel->name,
            $gradeLevel->display_name,
            $gradeLevel->created_at,
            $gradeLevel->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Display Name',
            'Created At',
            'Updated At',
        ];
    }
}
