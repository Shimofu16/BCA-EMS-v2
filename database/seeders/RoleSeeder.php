<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'administrator',
                'display_name' => 'Administrator'
            ],
            [
                'name' => 'registrar',
                'display_name' => 'Registrar'
            ],
            [
                'name' => 'cashier',
                'display_name' => 'Cashier'
            ],
            [
                'name' => 'teacher',
                'display_name' => 'Teacher'
            ],
            [
                'name' => 'student',
                'display_name' => 'Student'
            ],
        ];
        foreach ($roles as $key => $role) {
            Role::create($role);
        }
    }
}
