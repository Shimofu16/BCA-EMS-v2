<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class TeacherExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Teachers';
    }
    public function collection()
    {
        return Teacher::select(
            'id',
            'name',
            'gender',
            'age',
            'contact',
            'email',
            'isResigned',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($teacher): array
    {
        return [
            $teacher->id,
            $teacher->name,
            $teacher->gender,
            $teacher->age,
            $teacher->contact,
            $teacher->email,
            $teacher->isResigned,
            $teacher->created_at,
            $teacher->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Gender',
            'Age',
            'Contact',
            'Email',
            'Is Resigned',
            'Created At',
            'Updated At',
        ];
    }
}
