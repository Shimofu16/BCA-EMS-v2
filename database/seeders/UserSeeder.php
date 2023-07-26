<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'email' => Teacher::find(1)->email,
                'password' => Hash::make('password'),
                'first_role_id' => 1,
                'teacher_id' => Teacher::find(1)->id,
            ],

            [
                'email' => Teacher::find(2)->email,
                'password' => Hash::make('password'),
                'first_role_id' => 4,
                'teacher_id' => 2,
                'created_at' => now()
            ],
            [
                'email' => Teacher::find(3)->email,
                'password' => Hash::make('password'),
                'first_role_id' => 2,
                'second_role_id' => 3,
                'teacher_id' => 3,
                'created_at' => now()
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }

    }
}
