<?php

namespace Database\Seeders;

use App\Models\Programme;
use Illuminate\Database\Seeder;

class ProgrammeSeeder extends Seeder
{
    public function run(): void
    {
        $programmes = [
            ['code' => 'BBC', 'name' => 'Bachelor of Business Computing', 'faculty' => 'Computing & Informatics', 'level' => 'Bachelor', 'duration_years' => 3],
            ['code' => 'BIT', 'name' => 'Bachelor of Information Technology', 'faculty' => 'Computing & Informatics', 'level' => 'Bachelor', 'duration_years' => 3],
            ['code' => 'BCOM', 'name' => 'Bachelor of Commerce', 'faculty' => 'Commerce', 'level' => 'Bachelor', 'duration_years' => 3],
            ['code' => 'BPLM', 'name' => 'Bachelor of Procurement & Logistics Management', 'faculty' => 'Commerce', 'level' => 'Bachelor', 'duration_years' => 3],
            ['code' => 'BHRM', 'name' => 'Bachelor of Human Resource Management', 'faculty' => 'Management', 'level' => 'Bachelor', 'duration_years' => 3],
            ['code' => 'DCS', 'name' => 'Diploma in Computer Science', 'faculty' => 'Computing & Informatics', 'level' => 'Diploma', 'duration_years' => 2],
        ];

        foreach ($programmes as $programme) {
            // updateOrCreate keyed on the unique code → no duplicates on re-run
            Programme::updateOrCreate(['code' => $programme['code']], $programme);
        }
    }
}
