<?php

namespace App\Exports;

use App\Models\Level;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class LevelExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Levels';
    }
    public function collection()
    {
        return Level::select(
            'id',
            'name',
            'display_name',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($level): array
    {
        return [
            $level->id,
            $level->name,
            $level->display_name,
            $level->created_at,
            $level->updated_at,
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
