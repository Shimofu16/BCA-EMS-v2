<?php

namespace Database\Seeders;

use App\Models\SchoolYear;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolYearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolYears = [
            [
                'name' => '2021-2022',
                'start_date' => '2021-06-01',
                'end_date' => '2022-03-31',
                'is_active' => false,
                'enrollment_status' => 'closed',
                'grading_id' => 1,
            ],
            [
                'name' => '2022-2023',
                'start_date' => '2022-06-01',
                'end_date' => '2023-03-31',
                'is_active' => true,
                'enrollment_status' => 'open',
                'grading_id' => 1,
            ],
        ];
        foreach ($schoolYears as $schoolYear) {
            SchoolYear::create($schoolYear);
        }
    }
}
