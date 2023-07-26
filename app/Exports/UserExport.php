<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class UserExport implements FromCollection, WithHeadings, WithMapping,WithTitle, ShouldAutoSize
{
    /**
     * @return string
     */
    public function title(): string
    {
        return 'Users';
    }
    public function collection()
    {
        return User::select(
            'id',
            'email',
            'password',
            'status',
            'first_role_id',
            'second_role_id',
            'teacher_id',
            'student_id',
            'otp',
            'created_at',
            'updated_at'
        )->get();
    }

    public function map($user): array
    {
        return [
            $user->id,
            $user->email,
            $user->password,
            $user->status,
            $user->first_role_id,
            $user->second_role_id,
            $user->teacher_id,
            $user->student_id,
            $user->otp,
            $user->created_at,
            $user->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Email',
            'Password',
            'Status',
            'First Role ID',
            'Second Role ID',
            'Teacher ID',
            'Student ID',
            'OTP',
            'Created At',
            'Updated At',
        ];
    }
}
