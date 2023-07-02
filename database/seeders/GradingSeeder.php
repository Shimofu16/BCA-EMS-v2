<?php

namespace Database\Seeders;

use App\Models\Grading;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gradings = [
            ['name' => '1st Grading'],
            ['name' => '2nd Grading'],
            ['name' => '3rd Grading'],
            ['name' => '4th Grading'],
            ['name' => 'Final'],
        ];
        foreach ($gradings as $grading) {
            Grading::create($grading);
        }
    }
}
