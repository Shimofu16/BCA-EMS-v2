<?php

namespace App\Exports;


use App\Models\ActivityLog;
use  Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class UserLogExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Activity Logs';
    }
    public function collection()
    {
        // Retrieve the data from the database or any other source
        return ActivityLog::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Activity',
            'Description',
            'Created At',
            'Updated At',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->user_id,
            $row->activity,
            $row->description,
            $row->created_at,
            $row->updated_at,
        ];
    }
}
