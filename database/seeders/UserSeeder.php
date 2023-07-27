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
                'name' => 'Administrator',
                'gender' => 'Male',
                'email' => 'bcaadmin@app.com',
                'password' => Hash::make('password'),
                'first_role_id' => 1,
            ],

            [
                'email' => Teacher::find(1)->email,
                'password' => Hash::make('password'),
                'first_role_id' => 4,
                'teacher_id' => 2,
                'created_at' => now()
            ],
            [
                'name' => 'Registrar', 
                'gender' => 'Male',
                'email' => 'bcaregistrar@app.com',
                'password' => Hash::make('password'),
                'first_role_id' => 2,
                'second_role_id' => 3,
                'created_at' => now()
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
