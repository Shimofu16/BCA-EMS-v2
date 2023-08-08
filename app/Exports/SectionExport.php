<?php

namespace App\Exports;

use App\Models\Section;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class SectionExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Sections';
    }
    public function collection()
    {
        return Section::select(
            'id',
            'name',
            'teacher_id',
            'grade_level_id',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($section): array
    {
        return [
            $section->id,
            $section->name,
            $section->teacher_id,
            $section->grade_level_id,
            $section->created_at,
            $section->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Teacher ID',
            'Grade Level ID',
            'Created At',
            'Updated At',
        ];
    }
}
