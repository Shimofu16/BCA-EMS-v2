<?php

namespace App\Exports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class SubjectExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Subjects';
    }
    public function collection()
    {
        return Subject::select(
            'id',
            'subject',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($subject): array
    {
        return [
            $subject->id,
            $subject->subject,
            $subject->created_at,
            $subject->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Subject',
            'Created At',
            'Updated At',
        ];
    }
}
