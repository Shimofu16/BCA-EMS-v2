<?php

namespace Database\Seeders;

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
                'profile' => 'administrator',
                'path' => 'admin.png',
                'email' => 'bcaadmin@app.com',
                'password' => Hash::make('password'),
                'first_role_id' => 1,
            ],
            [
                'profile' => 'teacher',
                'path' => 'teacher.png',
                'email' => 'bcateacher@app.com',
                'password' => Hash::make('password'),
                'first_role_id' => 4,
                'teacher_id' => 3,
            ],
            [
                'profile' => 'registrar',
                'path' => 'registrar.png',
                'email' => 'bcaregistrar@app.com',
                'password' => Hash::make('password'),
                'first_role_id' => 2,
            ],
            [
                'profile' => 'cashier',
                'path' => 'cashier.png',
                'email' => 'bcacashier@app.com',
                'password' => Hash::make('password'),
                'first_role_id' => 3,
            ],
            [
                'profile' => 'cashier & registrar',
                'path' => 'cashier & registrar.png',
                'email' => 'bcaCR@app.com',
                'password' => Hash::make('password'),
                'first_role_id' => 2,
                'second_role_id' => 3,
            ],

        ];
    }
}
