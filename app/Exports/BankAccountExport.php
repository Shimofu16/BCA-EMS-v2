<?php

namespace App\Exports;

use App\Models\BankAccount;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class BankAccountExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'Bank Accounts';
    }
    public function collection()
    {
        return BankAccount::select(
            'id',
            'bank_name',
            'account_name',
            'account_number',
            'display',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($bankAccount): array
    {
        return [
            $bankAccount->id,
            $bankAccount->bank_name,
            $bankAccount->account_name,
            $bankAccount->account_number,
            $bankAccount->display,
            $bankAccount->created_at,
            $bankAccount->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Bank Name',
            'Account Name',
            'Account Number',
            'is To Display',
            'Created At',
            'Updated At',
        ];
    }
}
