<?php

namespace App\Exports;

use App\Models\Annual;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class AnnualExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Annuals';
    }
    public function collection()
    {
        return Annual::select(
            'id',
            'title',
            'amount',
            'fee_type',
            'level_id',
            'sy_id',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($annual): array
    {
        return [
            $annual->id,
            $annual->title,
            $annual->amount,
            $annual->fee_type,
            $annual->level_id,
            $annual->sy_id,
            $annual->created_at,
            $annual->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Amount',
            'Fee Type',
            'Level ID',
            'SY ID',
            'Created At',
            'Updated At',
        ];
    }
}
