<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SubjectSeeder::class,
            GradeLevelSeeder::class,
            GradingSeeder::class,
            SchoolYearSeeder::class,
            TeacherSeeder::class,
            SectionSeeder::class,
            LevelSeeder::class,
            AnnualSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
